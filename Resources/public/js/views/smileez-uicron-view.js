YUI.add('smileez-uicron-view', function (Y) {
    Y.namespace('smileEzUICron');

    Y.smileEzUICron.View = Y.Base.create('smileezuicronView', Y.eZ.ServerSideView, [], {
        events: {
            '.smile-cron-edit': {
                'tap': '_editField'
            }
        },

        initializer: function () {
            this.containerTemplate = '<div class="ez-view-smileezuicronview"/>';
        },

        _editField: function (e) {
            e.preventDefault();
            var type = e.target.getAttribute('data-type'),
                alias = e.target.getAttribute('data-alias'),
                cronValueNode = this.get('container').one('#smile-cron-value-' + type + '-' + alias),
                cronTdNode = this.get('container').one('#smile-cron-td-' + type + '-' + alias);

            cronTdNode.appendChild(Y.Node.create('<input type="text" size="10" id="' + type + '-' + alias + '" class="smile-cron-input" value="' + cronValueNode.getHTML().trim() + '">'));
            cronTdNode.appendChild(Y.Node.create('<input type="button" data-type="' + type + '" data-alias="' + alias + '" class="smile-cron-input" value="' + Y.eZ.trans('smileezuicron.button.cancel', {}, 'smileezcron') + '">'));
            cronTdNode.appendChild(Y.Node.create('<input type="button" data-type="' + type + '" data-alias="' + alias + '" class="smile-cron-input" value="' + Y.eZ.trans('smileezuicron.button.save', {}, 'smileezcron') + '">'));
            cronValueNode.addClass('editView');
        },
    });
});
