"use strict";

function _toConsumableArray(e) {
    return _arrayWithoutHoles(e) || _iterableToArray(e) || _unsupportedIterableToArray(e) || _nonIterableSpread()
}

function _nonIterableSpread() {
    throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
}

function _unsupportedIterableToArray(e, r) {
    if (e) {
        if ("string" == typeof e) return _arrayLikeToArray(e, r);
        var t = Object.prototype.toString.call(e).slice(8, -1);
        return "Object" === t && e.constructor && (t = e.constructor.name), "Map" === t || "Set" === t ? Array.from(e) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(e, r) : void 0
    }
}

function _iterableToArray(e) {
    if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e)
}

function _arrayWithoutHoles(e) {
    if (Array.isArray(e)) return _arrayLikeToArray(e)
}

function _arrayLikeToArray(e, r) {
    (null == r || r > e.length) && (r = e.length);
    for (var t = 0, a = new Array(r); t < r; t++) a[t] = e[t];
    return a
}

function _classCallCheck(e, r) {
    if (!(e instanceof r)) throw new TypeError("Cannot call a class as a function")
}

function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
        var a = r[t];
        a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
    }
}

function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), e
}

document.addEventListener("DOMContentLoaded", (function (e) {
    new Sliders, new GroupSlider, new Modals, new Tab, new Accordion, new StickyHeader, new MobileMenu, new MobileMenuDropdown
}));
var Accordion = function () {
    function e() {
        if (_classCallCheck(this, e), this.accordions = document.querySelectorAll("[data-accordion]"), this.arrayAccordions = Array.from(this.accordions), this.accordionNames = this.arrayAccordions.map((function (e) {
            return e.getAttribute("data-accordion")
        })), this.isHasDuplicates()) throw new Error('Accordions "names" have duplicates\n\rPlease change them');
        this.activeClass = "active", this.start()
    }

    return _createClass(e, [{
        key: "isHasDuplicates", value: function () {
            return this.accordionNames.length !== _toConsumableArray(new Set(this.accordionNames)).length
        }
    }, {
        key: "start", value: function () {
            var e = this;
            this.accordionNames.forEach((function (r) {
                var t = document.querySelector('[data-accordion="'.concat(r, '"]')),
                    a = t.querySelectorAll("[data-accordion-trigger]"),
                    n = t.querySelectorAll("[data-accordion-content]");
                if (a.length !== n.length) throw new Error("Number of triggers not equal to number of content blocks");
                e.setListener({triggers: a, contents: n})
            }))
        }
    }, {
        key: "setListener", value: function (e) {
            var r = this, t = e.triggers, a = e.contents;
            t.forEach((function (e, n) {
                e.addEventListener("click", (function (e) {
                    r.handler({triggers: t, contents: a, index: n})
                }))
            }))
        }
    }, {
        key: "handler", value: function (e) {
            var r = this, t = e.triggers, a = e.contents, n = e.index;
            t.forEach((function (e, t) {
                t === n ? e.classList.value.match(new RegExp(r.activeClass)) ? (r.removeClass(e), r.removeClass(a[t])) : (r.addClass(e), r.addClass(a[t])) : (r.removeClass(e), r.removeClass(a[t]))
            }))
        }
    }, {
        key: "addClass", value: function (e) {
            e.classList.add(this.activeClass)
        }
    }, {
        key: "removeClass", value: function (e) {
            e.classList.remove(this.activeClass)
        }
    }]), e
}();

function _toConsumableArray(e) {
    return _arrayWithoutHoles(e) || _iterableToArray(e) || _unsupportedIterableToArray(e) || _nonIterableSpread()
}

function _nonIterableSpread() {
    throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
}

function _unsupportedIterableToArray(e, r) {
    if (e) {
        if ("string" == typeof e) return _arrayLikeToArray(e, r);
        var t = Object.prototype.toString.call(e).slice(8, -1);
        return "Object" === t && e.constructor && (t = e.constructor.name), "Map" === t || "Set" === t ? Array.from(e) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(e, r) : void 0
    }
}

function _iterableToArray(e) {
    if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e)
}

function _arrayWithoutHoles(e) {
    if (Array.isArray(e)) return _arrayLikeToArray(e)
}

function _arrayLikeToArray(e, r) {
    (null == r || r > e.length) && (r = e.length);
    for (var t = 0, a = new Array(r); t < r; t++) a[t] = e[t];
    return a
}

function _classCallCheck(e, r) {
    if (!(e instanceof r)) throw new TypeError("Cannot call a class as a function")
}

function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
        var a = r[t];
        a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
    }
}

function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), e
}

var GroupSlider = function () {
    function e() {
        if (_classCallCheck(this, e), this.sliders = document.querySelectorAll("[data-group-slider-list]"), this.arraySliders = Array.from(this.sliders), this.slidersNames = this.arraySliders.map((function (e) {
            return e.getAttribute("data-group-slider-list")
        })), this.isHasDuplicates()) throw new Error('Sliders "names" have duplicates\n\rPlease change them');
        this.slidersData = [], this.setSlidersData(), this.initSliders()
    }

    return _createClass(e, [{
        key: "isHasDuplicates", value: function () {
            return this.slidersNames.length !== _toConsumableArray(new Set(this.slidersNames)).length
        }
    }, {
        key: "setSlidersData", value: function () {
            var e = this;
            this.arraySliders.forEach((function (r) {
                var t = r.getAttribute("data-group-slider-list"),
                    a = document.querySelector('[data-group-slider-arrow-prev="'.concat(t, '"]')),
                    n = document.querySelector('[data-group-slider-arrow-next="'.concat(t, '"]')),
                    i = {name: t, hasArrows: !!n && !!a, arrowPrev: a, arrowNext: n, list: r};
                e.slidersData.push(i)
            }))
        }
    }, {
        key: "initSliders", value: function () {
            this.slidersData.forEach((function (e) {
                var r = $(e.list), t = r.attr("data-slide-to-show") ? parseInt(r.attr("data-slide-to-show")) : 3, a = {
                    slidesToScroll: t,
                    slidesToShow: t,
                    dots: !0,
                    arrows: e.hasArrows,
                    infinite: !1,
                    responsive: [{breakpoint: 780, settings: {slidesToScroll: t - 1, slidesToShow: t - 1}}],
                    adaptiveHeight: !0
                };
                e.hasArrows && (a.prevArrow = e.arrowPrev, a.nextArrow = e.arrowNext), r.slick(a)
            }))
        }
    }]), e
}();

function _classCallCheck(e, r) {
    if (!(e instanceof r)) throw new TypeError("Cannot call a class as a function")
}

function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
        var a = r[t];
        a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
    }
}

function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), e
}

var MobileMenu = function () {
    function e() {
        if (_classCallCheck(this, e), this.triggers = document.querySelectorAll("[data-mobile-menu-trigger]"), this.content = document.querySelector("[data-mobile-menu-content]"), !this.content) throw new Error("Selector with attr '[data-mobile-menu-content]' not found");
        this.status = !1, this.cssClasses = {
            content: {active: "b-mobile-menu_active"},
            triggerHeader: {active: "b-header__mobile-menu-trigger_active"}
        }, this.init()
    }

    return _createClass(e, [{
        key: "init", value: function () {
            this.listener()
        }
    }, {
        key: "listener", value: function () {
            var e = this;
            Array.from(this.triggers).forEach((function (r) {
                r.addEventListener("click", (function () {
                    e.handleClick()
                }))
            }))
        }
    }, {
        key: "handleClick", value: function () {
            this.status ? this.close() : this.open()
        }
    }, {
        key: "open", value: function () {
            var e = this;
            document.body.style.overflow = "hidden", this.content.classList.add(this.cssClasses.content.active), this.status = !0, Array.from(this.triggers).forEach((function (r) {
                r.classList.add(e.cssClasses.triggerHeader.active)
            }))
        }
    }, {
        key: "close", value: function () {
            var e = this;
            document.body.style.overflow = "", this.content.classList.remove(this.cssClasses.content.active), this.status = !1, Array.from(this.triggers).forEach((function (r) {
                r.classList.remove(e.cssClasses.triggerHeader.active)
            }))
        }
    }]), e
}();

function _classCallCheck(e, r) {
    if (!(e instanceof r)) throw new TypeError("Cannot call a class as a function")
}

function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
        var a = r[t];
        a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
    }
}

function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), e
}

var MobileMenuDropdown = function () {
    function e() {
        if (_classCallCheck(this, e), this.place = document.querySelector(".b-mobile-menu__list"), this.triggers = this.place.querySelectorAll("ul > li > i"), this.contents = this.place.querySelectorAll("ul > li > ul"), this.triggers.length !== this.contents.length) throw new Error("Triggers length and contents length not equal");
        this.cssClasses = {trigger: {active: "active"}, content: {active: "active"}}, this.init()
    }

    return _createClass(e, [{
        key: "init", value: function () {
            this.listeners()
        }
    }, {
        key: "listeners", value: function () {
            var e = this;
            Array.from(this.triggers).forEach((function (r, t) {
                r.addEventListener("click", (function () {
                    e.handleClick(t)
                }))
            }))
        }
    }, {
        key: "handleClick", value: function (e) {
            this.toggle(e)
        }
    }, {
        key: "toggle", value: function (e) {
            this.triggers[e].classList.toggle(this.cssClasses.trigger.active), this.contents[e].classList.toggle(this.cssClasses.content.active)
        }
    }]), e
}();

function _toConsumableArray(e) {
    return _arrayWithoutHoles(e) || _iterableToArray(e) || _unsupportedIterableToArray(e) || _nonIterableSpread()
}

function _nonIterableSpread() {
    throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
}

function _unsupportedIterableToArray(e, r) {
    if (e) {
        if ("string" == typeof e) return _arrayLikeToArray(e, r);
        var t = Object.prototype.toString.call(e).slice(8, -1);
        return "Object" === t && e.constructor && (t = e.constructor.name), "Map" === t || "Set" === t ? Array.from(e) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(e, r) : void 0
    }
}

function _iterableToArray(e) {
    if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e)
}

function _arrayWithoutHoles(e) {
    if (Array.isArray(e)) return _arrayLikeToArray(e)
}

function _arrayLikeToArray(e, r) {
    (null == r || r > e.length) && (r = e.length);
    for (var t = 0, a = new Array(r); t < r; t++) a[t] = e[t];
    return a
}

function _classCallCheck(e, r) {
    if (!(e instanceof r)) throw new TypeError("Cannot call a class as a function")
}

function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
        var a = r[t];
        a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
    }
}

function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), e
}

var Modals = function () {
    function e() {
        if (_classCallCheck(this, e), this.modals = document.querySelectorAll("[data-modal-content]"), this.arrayModals = Array.from(this.modals), this.modalsNames = this.arrayModals.map((function (e) {
            return e.getAttribute("data-modal-content")
        })), this.isHasDuplicates()) throw new Error('Modals "names" have duplicates\n\rPlease change them');
        this.init()
    }

    return _createClass(e, [{
        key: "isHasDuplicates", value: function () {
            return this.modalsNames.length !== _toConsumableArray(new Set(this.modalsNames)).length
        }
    }, {
        key: "init", value: function () {
            var e = this;
            this.modalsNames.forEach((function (r) {
                var t = document.querySelector('[data-modal-content="'.concat(r, '"]')),
                    a = document.querySelectorAll('[data-modal-trigger="'.concat(r, '"]'));
                Array.from(a).forEach((function (r) {
                    r.addEventListener("click", (function (r) {
                        e.action(t)
                    }))
                }))
            }))
        }
    }, {
        key: "action", value: function (e) {
            e.classList.toggle("active"), document.body.classList.toggle("hidden")
        }
    }]), e
}();

function _toConsumableArray(e) {
    return _arrayWithoutHoles(e) || _iterableToArray(e) || _unsupportedIterableToArray(e) || _nonIterableSpread()
}

function _nonIterableSpread() {
    throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
}

function _unsupportedIterableToArray(e, r) {
    if (e) {
        if ("string" == typeof e) return _arrayLikeToArray(e, r);
        var t = Object.prototype.toString.call(e).slice(8, -1);
        return "Object" === t && e.constructor && (t = e.constructor.name), "Map" === t || "Set" === t ? Array.from(e) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(e, r) : void 0
    }
}

function _iterableToArray(e) {
    if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e)
}

function _arrayWithoutHoles(e) {
    if (Array.isArray(e)) return _arrayLikeToArray(e)
}

function _arrayLikeToArray(e, r) {
    (null == r || r > e.length) && (r = e.length);
    for (var t = 0, a = new Array(r); t < r; t++) a[t] = e[t];
    return a
}

function _classCallCheck(e, r) {
    if (!(e instanceof r)) throw new TypeError("Cannot call a class as a function")
}

function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
        var a = r[t];
        a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
    }
}

function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), e
}

var Sliders = function () {
    function e() {
        if (_classCallCheck(this, e), this.sliders = document.querySelectorAll("[data-slider-list]"), this.arraySliders = Array.from(this.sliders), this.slidersNames = this.arraySliders.map((function (e) {
            return e.getAttribute("data-slider-list")
        })), this.isHasDuplicates()) throw new Error('Sliders "names" have duplicates\n\rPlease change them');
        this.slidersData = [], this.setSlidersData(), this.initSliders()
    }

    return _createClass(e, [{
        key: "isHasDuplicates", value: function () {
            return this.slidersNames.length !== _toConsumableArray(new Set(this.slidersNames)).length
        }
    }, {
        key: "setSlidersData", value: function () {
            var e = this;
            this.arraySliders.forEach((function (r) {
                var t = r.getAttribute("data-slider-list"),
                    a = document.querySelector('[data-slider-arrow-prev="'.concat(t, '"]')),
                    n = document.querySelector('[data-slider-arrow-next="'.concat(t, '"]')),
                    i = {name: t, hasArrows: !!n && !!a, arrowPrev: a, arrowNext: n, list: r};
                e.slidersData.push(i)
            }))
        }
    }, {
        key: "initSliders", value: function () {
            var e = this;
            this.slidersData.forEach((function (r) {
                var t = $(r.list), a = {
                    slidesToScroll: 1,
                    slidesToShow: 1,
                    dots: !0,
                    arrows: r.hasArrows,
                    infinite: !0,
                    responsive: [],
                    adaptiveHeight: !0
                };
                r.hasArrows && (a.prevArrow = r.arrowPrev, a.nextArrow = r.arrowNext), t.on("init", (function (a) {
                    r.hasArrows && (e.setPositionArrows({
                        arrowPrev: r.arrowPrev,
                        arrowNext: r.arrowNext,
                        firstChildren: t.children().first()
                    }), window.addEventListener("resize", (function (a) {
                        e.setPositionArrows({
                            arrowPrev: r.arrowPrev,
                            arrowNext: r.arrowNext,
                            firstChildren: t.children().first()
                        })
                    })))
                })), t.slick(a), document.addEventListener("resize", (function (e) {
                    window.innerWidth >= 560 && t.slick("reinit")
                }))
            }))
        }
    }, {
        key: "setPositionArrows", value: function (e) {
            var r = e.arrowPrev, t = e.arrowNext, a = e.firstChildren.height() / 2;
            r.style.top = "".concat(a, "px"), t.style.top = "".concat(a, "px")
        }
    }]), e
}();

function _classCallCheck(e, r) {
    if (!(e instanceof r)) throw new TypeError("Cannot call a class as a function")
}

function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
        var a = r[t];
        a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
    }
}

function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), e
}

var StickyHeader = function () {
    function e() {
        _classCallCheck(this, e), this.header = document.querySelector(".b-header"), this.options = {startOffset: null}, this.cssFixedClass = "b-header_fixed", this.start()
    }

    return _createClass(e, [{
        key: "start", value: function () {
            this.setOptions(), this.listeners()
        }
    }, {
        key: "listeners", value: function () {
            var e = this;
            window.addEventListener("scroll", (function (r) {
                e.scrollHandler()
            })), window.addEventListener("resize", (function (r) {
                e.setOptions()
            }))
        }
    }, {
        key: "setOptions", value: function () {
            this.options.startOffset = window.innerHeight / 2
        }
    }, {
        key: "scrollHandler", value: function () {
            var e = window.scrollY >= this.options.startOffset;
            this.setHeaderSticky(e)
        }
    }, {
        key: "setHeaderSticky", value: function (e) {
            e ? (this.header.classList.add(this.cssFixedClass), document.body.style.paddingTop = "".concat(this.header.getBoundingClientRect().height, "px")) : (this.header.classList.remove(this.cssFixedClass), document.body.style.paddingTop = "")
        }
    }]), e
}();

function _toConsumableArray(e) {
    return _arrayWithoutHoles(e) || _iterableToArray(e) || _unsupportedIterableToArray(e) || _nonIterableSpread()
}

function _nonIterableSpread() {
    throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
}

function _unsupportedIterableToArray(e, r) {
    if (e) {
        if ("string" == typeof e) return _arrayLikeToArray(e, r);
        var t = Object.prototype.toString.call(e).slice(8, -1);
        return "Object" === t && e.constructor && (t = e.constructor.name), "Map" === t || "Set" === t ? Array.from(e) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(e, r) : void 0
    }
}

function _iterableToArray(e) {
    if ("undefined" != typeof Symbol && Symbol.iterator in Object(e)) return Array.from(e)
}

function _arrayWithoutHoles(e) {
    if (Array.isArray(e)) return _arrayLikeToArray(e)
}

function _arrayLikeToArray(e, r) {
    (null == r || r > e.length) && (r = e.length);
    for (var t = 0, a = new Array(r); t < r; t++) a[t] = e[t];
    return a
}

function _classCallCheck(e, r) {
    if (!(e instanceof r)) throw new TypeError("Cannot call a class as a function")
}

function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
        var a = r[t];
        a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
    }
}

function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), e
}

var Tab = function () {
    function e() {
        if (_classCallCheck(this, e), this.tabs = document.querySelectorAll("[data-tab]"), this.arrayTabs = Array.from(this.tabs), this.tabsNames = this.arrayTabs.map((function (e) {
            return e.getAttribute("data-tab")
        })), this.isHasDuplicates()) throw new Error('Tabs "names" have duplicates\n\rPlease change them');
        this.activeClass = "active", this.start()
    }

    return _createClass(e, [{
        key: "isHasDuplicates", value: function () {
            return this.tabsNames.length !== _toConsumableArray(new Set(this.tabsNames)).length
        }
    }, {
        key: "start", value: function () {
            var e = this;
            this.tabsNames.forEach((function (r) {
                var t = document.querySelector('[data-tab="'.concat(r, '"]')),
                    a = t.querySelectorAll("[data-tab-trigger]"), n = t.querySelectorAll("[data-tab-content]");
                if (a.length !== n.length) throw new Error("Number of triggers not equal to number of content blocks");
                e.setListener({triggers: a, contents: n})
            }))
        }
    }, {
        key: "setListener", value: function (e) {
            var r = this, t = e.triggers, a = e.contents;
            t.forEach((function (e, n) {
                e.addEventListener("click", (function (e) {
                    r.handler({triggers: t, contents: a, index: n})
                }))
            }))
        }
    }, {
        key: "handler", value: function (e) {
            var r = this, t = e.triggers, a = e.contents, n = e.index;
            t.forEach((function (e, t) {
                t === n ? e.classList.value.match(new RegExp(r.activeClass)) ? (r.removeClass(e), r.removeClass(a[t])) : (r.addClass(e), r.addClass(a[t])) : (r.removeClass(e), r.removeClass(a[t]))
            }))
        }
    }, {
        key: "addClass", value: function (e) {
            e.classList.add(this.activeClass)
        }
    }, {
        key: "removeClass", value: function (e) {
            e.classList.remove(this.activeClass)
        }
    }]), e
}();
//# sourceMappingURL=main.js.map
