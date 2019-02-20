var JzTabPanel = Class.create();
JzTabPanel.prototype = {
    initialize : function (elm)
    {
        this.tabPanel = $(elm);

        var query = 'div#' + this.tabPanel.id 
                  + ' ul.TabGroup > li.Tab a';
        this.tabs = $$(query);

        this._show(this._getInitialTab());
        this.tabs.each(this._setupTab.bind(this));
    },

    _setupTab : function(elm)
    {
        Event.observe(elm, 'click', this._activate.bindAsEventListener(this), false);
    },
    
    _activate :  function(ev)
    {
        var elm = Event.findElement(ev, "a");
        Event.stop(ev);
        this._show(elm);
        this.tabs.without(elm).each(this._hide.bind(this));
    },

    _show : function(elm)
    {
        $(elm).getOffsetParent().addClassName('Selected');
        $(this._getTabID(elm)).addClassName('ActivePanel');
    },
    
    _hide : function(elm)
    {
        $(elm).getOffsetParent().removeClassName('Selected');
        $(this._getTabID(elm)).removeClassName('ActivePanel');
    },

    _getTabID : function(elm)
    {
       return elm.href.match(/#([a-zA-Z0-9-]+)/)[1];
    },

    _getInitialTab : function()
    {
        if (document.location.href.match(/#([a-zA-Z0-9-]+)/)) {
            var loc = RegExp.$1;
            var elm = this.tabs.find(function(value) { 
                return value.href.match(/#([a-zA-Z0-9-]+)/)[1] == loc; 
            });
            
            return elm || this.tabs.first();
        } else {
             return this.tabs.first();
        }
    }
};
