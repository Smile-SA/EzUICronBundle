YUI.add('smileez-uicron-applugin', function (Y) {
    Y.namespace('smileEzUICron.Plugin');

    Y.smileEzUICron.Plugin.AppPlugin = Y.Base.create('smileezuicronAppPlugin', Y.Plugin.Base, [], {
        initializer: function () {
            var app = this.get('host');

            app.views.smileezuicronView = {
                type: Y.smileEzUICron.View
            };

            app.route({
                name: "smileezuiCronNavigation",
                path: "/smileezsb/sb",
                view: "smileezuicronView",
                service: Y.smileEzUICron.ViewService,
                sideViews: {'navigationHub': true, 'discoveryBar': false},
                callbacks: ['open', 'checkUser', 'handleSideViews', 'handleMainView'],
            });
        }
    }, {
        NS: 'smileezuicronTypeApp'
    });

    Y.eZ.PluginRegistry.registerPlugin(
        Y.smileEzUICron.Plugin.AppPlugin, ['platformuiApp']
    );
});
