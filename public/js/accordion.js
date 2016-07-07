var Accordion = function(){
    this.tabs = [];
    this.visibleTabId = null;
};

Accordion.prototype.addTab = function(id, ajaxUrl, alwaysReload){
    this.removeTab(id);
    var tab = new AccordionTab(id, ajaxUrl, alwaysReload);
    this.tabs.push(tab);

    if(this.tabs.length == 1){
        this.visibleTabId = id;
    }
};

Accordion.prototype.getTab = function(id){
    for(var x=0; x < this.tabs.length; x++){
        if(this.tabs[x].getId() == id){
            return this.tabs[x];
        }
    }
    return false;
};

Accordion.prototype.removeTab = function(id){
    for(var x=0; x < this.tabs.length; x++){
        if(this.tabs[x].getId() == id){
            return this.tabs.splice(x, 1);
        }
    }
};

Accordion.prototype.render = function(){
    for(var x=0; x < this.tabs.length; x++){
        if(this.tabs[x].getId() != this.visibleTabId){
            this.tabs[x].hide();
        }else{
            this.tabs[x].show();
        }
    }
};

Accordion.prototype.showTab = function(id){
    if(this.getTab(id)){
        this.visibleTabId = id;
        this.render();
    }
};

var AccordionTab = function(id, ajaxUrl, alwaysReload){
    this.id = id;
    this.ajaxUrl = ajaxUrl;
    this.alwaysReload = alwaysReload;
};

AccordionTab.prototype.getId = function(){
    return this.id;
};

AccordionTab.prototype.show = function(){
    var tabContent = $('[tab-content="' + this.id + '"]');
    tabContent.show();
    $('[tab-selector="' + this.id + '"]').addClass('active');

    if(tabContent.html() == '' || this.alwaysReload){
        tabContent.html('Loading...');
        $.ajax({
            url: this.ajaxUrl,
            success: function(response){
                tabContent.html(response);
            }
        })
    }
};

AccordionTab.prototype.hide = function(){
    $('[tab-content="' + this.id + '"]').hide();
    $('[tab-selector="' + this.id + '"]').removeClass('active');
};