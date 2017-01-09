YUI.add('smileez-uicron-view', function (Y) {
    Y.namespace('smileEzUICron');
    var onEdit = false;

    Y.smileEzUICron.View = Y.Base.create('smileezuicronView', Y.eZ.ServerSideView, [], {
        events: {
            '.smile-cron-edit': {
                'tap': '_editField'
            },
            '.smile-cron-cancel': {
                'tap': '_cancelEditField'
            },
            '.smile-cron-save': {
                'tap': '_saveEditField'
            }
        },

        initializer: function () {
            this.containerTemplate = '<div class="ez-view-smileezuicronview"/>';
        },

        _editField: function (e) {
            e.preventDefault();

            if (onEdit) return;
            var type = e.target.getAttribute('data-type'),
                alias = e.target.getAttribute('data-alias'),
                container = this.get('container'),
                cronValueNode = container.one('#smile-cron-value-' + type + '-' + alias),
                cronTdNode = container.one('#smile-cron-td-' + type + '-' + alias),
                cronAllTdNodes = container.all('.smile-cron-edit');

            if (cronTdNode) {
                cronAllTdNodes.each(function(tdNode) {
                    var tdType = tdNode.getAttribute('data-type'),
                        tdAlias = tdNode.getAttribute('data-alias'),
                        cronContainerNode = container.one('#smile-cron-container-' + tdType + '-' + tdAlias),
                        cronValueNode = container.one('#smile-cron-value-' + tdType + '-' + tdAlias);

                    if (cronContainerNode) {
                        cronValueNode.removeClass('editView');
                        tdNode.removeChild(cronContainerNode);
                    }
                });

                cronTdNode.appendChild(Y.Node.create('<div id="smile-cron-container-' + type + '-' + alias + '"></div>'));

                var cronContainerNode = this.get('container').one('#smile-cron-container-' + type + '-' + alias);

                onEdit = true;
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
                container = this.get('container'),
                cronValueNode = container.one('#smile-cron-value-' + type + '-' + alias),
                cronTdNode = container.one('#smile-cron-td-' + type + '-' + alias),
                cronContainerNode = container.one('#smile-cron-container-' + type + '-' + alias);

            if (cronTdNode) {
                onEdit = false;
                cronValueNode.removeClass('editView');
                cronTdNode.removeChild(cronContainerNode);
            }
        },

        _saveEditField: function (e) {
            e.preventDefault();
            var type = e.target.getAttribute('data-type'),
                alias = e.target.getAttribute('data-alias'),
                container = this.get('container'),
                cronInput = container.one('#' + type + '-' + alias),
                cronValueNode = container.one('#smile-cron-value-' + type + '-' + alias),
                cronTdNode = container.one('#smile-cron-td-' + type + '-' + alias),
                cronContainerNode = container.one('#smile-cron-container-' + type + '-' + alias);

            if (cronTdNode && cronInput) {
                var inputValue = cronInput.get('value');

                cronValueNode.setHTML(inputValue);
                cronValueNode.removeClass('editView');
                cronTdNode.removeChild(cronContainerNode);
                onEdit = false;
            }
        },
    });
});
