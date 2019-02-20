var DataStore = Class.create(Enumerable, {
	initialize: function(store) {
		if(store == null) {
			store = [];
		}

		this._store = store;
	},

	addItem: function(text, value) {
		if(value == null) {
			value = text;
		}

		this._store.push({text: text, value: value});
	},

	removeItem: function(idx) {
		this._store.splice(idx, 1);
	},

	clear: function() {
		this._store = [];
	},

	size: function() {
		return this._store.length;
	},

	inspect: function() {
		alert(this._store.inspect());
	},

	_each: function(iterator) {
		for (var i = 0; i < this._store.length; i++) {
			var value = this._store[i];

			iterator(value);
		}
	}
});

var HTMLSelect = Class.create({
	initialize: function(element) {
		this.element = $(element);
		this.element.onchange = this.onChange.bindAsEventListener(this);
		this.element.onclick = this.onClick.bindAsEventListener(this);
		this.element.onfocus = this.onFocus.bindAsEventListener(this);

		var store = new DataStore();
		var opts = this.element.options;
		for(var i = 0; i < opts.length; i++ ) {
			var el = opts[i];
			store.addItem(el.text, el.value);
		}

		this.store = store;
	},

	setStore: function(ds) {
		this.store = ds;
	},

	reload: function() {
		this.empty();

		var num = 0;
		this.store.each(function(item) {
			this.addOption(item.text, item.value);
			num++;
		}.bind(this));
	},

	onChange: function(e) {},
	onClick: function(e) {},
	onFocus: function(e) {},
	onEmpty: function() { return true; },

	selectIndex: function( index ) {
		this.element.selectedIndex = index;
	},

	selectOption: function(option, update) {
        if (typeof update == 'undefined') { update = true; }
		var size = this.element.length;
		var found = false;
		for(i = 0; i < size; i++) {
			// var el = this.element.options[i].text;
            var el = this.element.options[i].value;
			if( el == option ) {
				found = true;
				break;
			}
		}

		if(found) {
			this.selectIndex(i);
			if (update) { this.onChange(); }
		}
	},

	countOptions: function() {
		return this.element.length;
	},

	getSelectedOption: function() {
		var op = this.element.options[this.element.selectedIndex];
		return { value: op.value, text: op.text };
	},

	getValue: function() {
		var op = this.element.options[this.element.selectedIndex];
		var ret = "";

		ret = op.value;
		if( ret == "" ) {
			ret = op.text;
		}

		return ret;
	},

	empty: function() {
		if(this.onEmpty()) {
			this._empty();
		}
	},

	addOption: function(text, value) {
        text = this._unescapeHTML(text);

        if(value == null) {
			value = text;
		}

		var op = new Option(text, value);

		var idx = this.element.length;
		this.element.options[idx] = op;

		return idx;
	},

    _unescapeHTML: function(html) {
        var htmlNode = new Element('div', {});
        htmlNode.innerHTML = html;

        if(htmlNode.innerText)
            return htmlNode.innerText; // IE

        return htmlNode.textContent; // FF
    },

	deleteOption: function(index) {
		if( this.element.length > 0 && index > 0 ) {
			this.element.options[index] = null;
		}
	},

	selectAllOptions: function() {
		var size = this.element.length - 1;
		for(i = size; i>=0; i--) {
			this.element.options[i].selected = true;
		}
	},

	getSelectedOptions: function() {
		var texts = [];
		var size = this.element.length - 1;
		for(i = size; i>=0; i--) {
			if( this.element.options[i].selected === true ) {
				texts.push(this.element.options[i].text);
			}
		}

		return texts;
	},

	_empty: function() {
		this.element.options.length = 0;
	}
});

var DependantSelectAJAX = Class.create(HTMLSelect, {
	initialize: function($super, select, child, url, options) {
        this.options = Object.extend({
            method: "post",
			controlName: "controlName",
			selectedName: "selectedId"
		}, options || {});

		$super(select);
		if(typeof(select ) == "string") {
			this.name = select;
		} else {
			this.name = select.name;
		}

		this.child = child;
		this.url = url;
	},

	onChange: function(e) {
		this.child.empty();
		var value = this.getValue();

		if(value != "") {
			var request = new Ajax.Request(this.url, {
				method: this.options.method,
				parameters: this.options.controlName + "=" + this.name + "&" + this.options.selectedName + "=" + value,
                onLoading: function() {
                    this.child.empty();
                    this.child.addOption('Cargando...', '');
                }.bind(this),
				onSuccess: function(transport) {
					var store = transport.responseText.evalJSON(true);
					if(typeof store.error != "undefined") {
						alert(store.error);
					} else {
						this.child.setStore(new DataStore(store));
						this.child.reload();

						var size = this.child.countOptions();
						if(size >= 1) {
							this.child.onChange();
						}
					}
				}.bind(this),
				onFalure: function(t) {
					alert( "Error in request" );
				}
			});
		}
	},

	onEmpty: function() {
		this.child.empty();

		return true;
	}
});
