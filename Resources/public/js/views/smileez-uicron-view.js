YUI.add('smileez-uicron-view', function (Y) {
    Y.namespace('smileEzUICron');

    Y.smileEzUICron.View = Y.Base.create('smileezuicronView', Y.eZ.ServerSideView, [], {
        events: {
            '.smile-cron-edit': {
                'tap': '_editField'
            },
            '.smile-cron-cancel': {
                'tap': '_cancelEditField'
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

            if (cronTdNode) {
                cronTdNode.appendChild(Y.Node.create('<div id="smile-cron-container-' + type + '-' + alias + '"></div>'));

                var cronContainerNode = this.get('container').one('#smile-cron-container-' + type + '-' + alias);

                cronContainerNode.appendChild(Y.Node.create('<input type="text" size="10" id="' + type + '-' + alias + '" class="smile-cron-input" value="' + cronValueNode.getHTML().trim() + '">'));
                cronContainerNode.appendChild(Y.Node.create('<input type="button" data-type="' + type + '" data-alias="' + alias + '" class="smile-cron-cancel" value="' + Y.eZ.trans('smileezuicron.button.cancel', {}, 'smileezcron') + '">'));
                cronContainerNode.appendChild(Y.Node.create('<input type="button" data-type="' + type + '" data-alias="' + alias + '" class="smile-cron-save" value="' + Y.eZ.trans('smileezuicron.button.save', {}, 'smileezcron') + '">'));
                cronValueNode.addClass('editView');
            }
        },

        _cancelEditField: function (e) {
            e.preventDefault();
            var type = e.target.getAttribute('data-type'),
                alias = e.target.getAttribute('data-alias'),
                cronValueNode = this.get('container').one('#smile-cron-value-' + type + '-' + alias),
                cronTdNode = this.get('container').one('#smile-cron-td-' + type + '-' + alias),
                cronContainerNode = this.get('container').one('#smile-cron-container-' + type + '-' + alias);

            if (cronTdNode) {
                cronValueNode.removeClass('editView');
                cronTdNode.removeChild(cronContainerNode);
            }
        },
    });
});
