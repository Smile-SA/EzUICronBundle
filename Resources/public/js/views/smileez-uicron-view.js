YUI.add('smileez-uicron-view', function (Y) {
    Y.namespace('smileEzUICron');

    Y.smileEzUICron.View = Y.Base.create('smileezuicronView', Y.eZ.ServerSideView, [], {
        initializer: function () {
console.log('ZZZ0 initializer view')
            this.containerTemplate = '<div class="ez-view-smileezuicronview"/>';
        },
    });
});