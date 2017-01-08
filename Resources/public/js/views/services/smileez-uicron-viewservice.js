YUI.add('smileez-uicron-viewservice', function (Y) {
    Y.namespace('smileEzUICron');

    Y.smileEzUICron.ViewService = Y.Base.create('smileezuicronViewService', Y.eZ.ServerSideViewService, [], {
        initializer: function () {
            this.on('*:navigateTo', function (e) {
                this.get('app').navigateTo(
                    e.routeName,
                    e.routeParams
                );
            });
        },

        _load: function (callback) {
            uri = this.get('app').get('apiRoot') + 'cron/status/tab';

            Y.io(uri, {
                method: 'GET',
                on: {
                    success: function (tId, response) {
                        this._parseResponse(response);
                        callback(this);
                    },
                    failure: this._handleLoadFailure
                },
                context: this
            });
        }
    });
});
