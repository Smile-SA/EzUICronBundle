YUI.add('smileez-uicron-navigationplugin', function (Y) {
    Y.namespace('smileEzUICron.Plugin');

    Y.smileEzUICron.Plugin.NavigationPlugin = Y.Base.create('smileezuicronNavigationPlugin', Y.eZ.Plugin.ViewServiceBase, [], {
        initializer: function () {
            var service = this.get('host'); // the plugged object is called host

            service.addNavigationItem({
                Constructor: Y.eZ.NavigationItemView,
                config: {
                    title: Y.eZ.trans('smileezuicron.navigationhub.cron.title', {}, 'smileeznavigationhub'),
                    identifier: "smileez-uicron-cron",
                    route: {
                        name: "smileezuiCronNavigation"
                    }
                }
            }, 'admin');
        },
    }, {
        NS: 'smileezuiCronNavigation'
    });

    Y.eZ.PluginRegistry.registerPlugin(
        Y.smileEzUICron.Plugin.NavigationPlugin, ['navigationHubViewService']
    );
});
