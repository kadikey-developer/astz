'use strict';

var exports = {};

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

var KEYS = {
	BACKSPACE: 8,
	ENTER: 13,
	ESC: 27,
	PAGE_UP: 33,
	PAGE_DOWN: 34,
	UP: 38,
	DOWN: 40
};

var randomString = function randomString(length) {
	var result = [];
	for (var i = 0; i < length; i++) {
		var k = Math.floor(Math.random() * chars.length);
		result.push(chars[k]);
	}
	return result.join('');
};

var create = function create(html) {
	var div = document.createElement('div');
	div.innerHTML = html;
	return div.children[0];
};

var Select = exports.Select = function () {
	function Select(id, original) {
		_classCallCheck(this, Select);

		this.id = id;
		this.original = original;
		this.focus = -1;
		this.indexMap = [];

		this.createElements();
		original.hidden = true;
		original.before(this.wrapper);
	}

	_createClass(Select, [{
		key: 'createElements',
		value: function createElements() {
			var _this = this;

			this.wrapper = create('<div class="select" role="combobox" aria-expanded="false" aria-has-popup="listbox">');
			this.input = create('<input aria-autocomplete="list" autocomplete="off" readonly>');
			this.dropdown = create('<ul class="select__dropdown" role="listbox" tabindex="-1">');

			if (this.original.multiple) {
				var inputWrapper = create('<div class="select__input">');
				this.values = create('<ul>');
				inputWrapper.append(this.values);
				inputWrapper.append(this.input);
				this.wrapper.append(inputWrapper);
			} else {
				this.wrapper.append(this.input);
			}

			this.wrapper.append(this.dropdown);

			this.input.disabled = this.original.disabled;
			// this.dropdown.setAttribute('aria-labelledby', 'TODO');

			this.input.onkeydown = this.onkeydown.bind(this);
			this.input.oninput = this.oninput.bind(this);
			this.input.onblur = this.onblur.bind(this);
			this.input.onclick = function () {
				if (_this.focus === -1) {
					_this.open(true);
				} else {
					_this.close();
				}
			};

			// Prevent blurring input. This also ensures dragging the cursor away from
			// the list item will cancel the selection
			this.dropdown.onmousedown = function (event) {
				event.preventDefault();
			};

			this.updateValue();
		}
	}, {
		key: 'isMatch',
		value: function isMatch(s) {
			var q = this.input.value.toLowerCase();
			return s.toLowerCase().indexOf(q) !== -1;
		}
	}, {
		key: 'update',
		value: function update() {
			var _this2 = this;

			var options = this.dropdown.querySelectorAll('[role="option"]');
			if (this.focus !== -1 && options.length) {
				Array.from(options).forEach(function (li, i) {
					var op = _this2.original.options[_this2.indexMap[i]];
					li.classList.toggle('select--has-focus', i === _this2.focus);
					li.classList.toggle('select--selected', _this2.original.multiple && op.selected);
					li.setAttribute('aria-selected', op.selected);
				});
				this.wrapper.setAttribute('aria-expanded', 'true');
				this.input.setAttribute('aria-activedescendant', this.id + '_option_' + this.indexMap[this.focus]);
				options[this.focus].scrollIntoView({ block: 'nearest' });
			} else {
				this.wrapper.setAttribute('aria-expanded', 'false');
				this.input.setAttribute('aria-activedescendant', '');
			}
		}
	}, {
		key: 'updateValue',
		value: function updateValue() {
			var _this3 = this;

			if (this.original.multiple) {
				this.input.value = '';
				this.values.innerHTML = '';
				Array.from(this.original.options).forEach(function (op, i) {
					if (op.selected && op.label) {
						var li = create('<li>');
						li.textContent = op.label;
						li.onclick = function () {
							_this3.original.options[i].selected = false;
							li.remove();
							_this3.input.focus();
						};
						_this3.values.append(li);
					}
				});
			} else {
				if (this.original.selectedOptions.length) {
					this.input.value = this.original.selectedOptions[0].label;
				}
			}
		}
	}, {
		key: 'createOption',
		value: function createOption(op, i) {
			var _this4 = this;

			var li = create('<li role="option">');
			li.id = this.id + '_option_' + i;
			li.textContent = op.label;
			if (op.disabled) {
				li.setAttribute('aria-disabled', 'true');
			} else {
				li.onclick = function () {
					_this4.setValue(i, _this4.original.multiple);
					_this4.input.focus();
				};
			}
			this.indexMap.push(i);
			return li;
		}
	}, {
		key: 'open',
		value: function open(forceAll) {
			var _this5 = this;

			this.focus = 0;
			this.dropdown.innerHTML = '';
			this.indexMap = [];
			var i = 0;
			Array.from(this.original.children).forEach(function (child) {
				if (child.tagName === 'OPTION') {
					if (child.label && (forceAll || _this5.isMatch(child.label))) {
						_this5.dropdown.append(_this5.createOption(child, i));
					}
					i += 1;
				} else {
					var group = create('<li role="group">');
					var label = create('<strong>');
					var ul = create('<ul role="none">');
					label.textContent = child.label;
					group.append(label);
					group.append(ul);
					Array.from(child.children).forEach(function (c) {
						if (c.label && (forceAll || _this5.isMatch(c.label))) {
							ul.append(_this5.createOption(c, i));
						}
						i += 1;
					});
					if (ul.children.length) {
						_this5.dropdown.append(group);
					}
				}
			});
			this.update();
		}
	}, {
		key: 'close',
		value: function close() {
			this.focus = -1;
			this.dropdown.innerHTML = '';
			this.indexMap = [];
			this.update();
		}
	}, {
		key: 'moveFocus',
		value: function moveFocus(k) {
			this.focus += k;
			this.focus = Math.max(this.focus, 0);
			this.focus = Math.min(this.focus, this.indexMap.length - 1);
			this.update();
		}
	}, {
		key: 'setValue',
		value: function setValue(i, toggle) {
			if (toggle) {
				this.original.options[i].selected = !this.original.options[i].selected;
			} else {
				this.original.options[i].selected = true;
			}
			this.original.dispatchEvent(new Event('change'));
			this.close();
			this.update();
			this.updateValue();
		}
	}, {
		key: 'onkeydown',
		value: function onkeydown(event) {
			if (this.focus !== -1) {
				if (event.keyCode === KEYS.DOWN) {
					event.preventDefault();
					this.moveFocus(1);
				} else if (event.keyCode === KEYS.PAGE_DOWN) {
					event.preventDefault();
					this.moveFocus(10);
				} else if (event.keyCode === KEYS.UP) {
					event.preventDefault();
					this.moveFocus(-1);
				} else if (event.keyCode === KEYS.PAGE_UP) {
					event.preventDefault();
					this.moveFocus(-10);
				} else if (event.keyCode === KEYS.ENTER) {
					event.preventDefault();
					this.setValue(this.indexMap[this.focus]);
				} else if (event.keyCode === KEYS.ESC) {
					this.input.value = '';
					this.close();
				}
			} else {
				if (event.keyCode === KEYS.DOWN) {
					event.preventDefault();
					this.open(true);
				}
			}
			if (this.original.multiple && !this.input.value && event.keyCode === KEYS.BACKSPACE) {
				event.preventDefault();
				var n = this.original.selectedOptions.length;
				if (n) {
					var op = this.original.selectedOptions[n - 1];
					op.selected = false;
					this.updateValue();
					this.input.value = op.label;
				}
			}
		}
	}, {
		key: 'oninput',
		value: function oninput(event) {
			var _this6 = this;

			if (this.input.value) {
				this.open(false);
			} else {
				this.close();
			}
			if (Array.from(this.original.options).some(function (op) {
				return _this6.isMatch(op.label);
			})) {
				this.input.setCustomValidity('');
			} else {
				this.input.setCustomValidity('invalid choice');
			}
		}
	}, {
		key: 'onblur',
		value: function onblur(event) {
			if (!this.input.value) {
				if (!this.original.multiple) {
					this.original.value = '';
				}
				this.close();
			} else if (this.indexMap.length) {
				this.setValue(this.indexMap[this.focus]);
			}
			if (!this.original.checkValidity()) {
				this.input.setCustomValidity(this.original.validationMessage);
			}
		}
	}]);

	return Select;
}();

Array.from(document.querySelectorAll('[data-select]')).forEach(function (el) {
	new Select(randomString(8), el);
});