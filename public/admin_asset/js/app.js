!function () {
    function f() {
        var e;
        document.querySelectorAll(".navbar-nav .collapse") && (e = document.querySelectorAll(".navbar-nav .collapse"), Array.from(e).forEach(function (t) {
            var a = new bootstrap.Collapse(t, {toggle: !1});
            t.addEventListener("show.bs.collapse", function (e) {
                e.stopPropagation();
                var e = t.parentElement.closest(".collapse");
                e ? (e = e.querySelectorAll(".collapse"), Array.from(e).forEach(function (e) {
                    e = bootstrap.Collapse.getInstance(e);
                    e !== a && e.hide()
                })) : (e = function (e) {
                    for (var t = [], a = e.parentNode.firstChild; a;) 1 === a.nodeType && a !== e && t.push(a), a = a.nextSibling;
                    return t
                }(t.parentElement), Array.from(e).forEach(function (e) {
                    2 < e.childNodes.length && e.firstElementChild.setAttribute("aria-expanded", "false");
                    e = e.querySelectorAll("*[id]");
                    Array.from(e).forEach(function (e) {
                        e.classList.remove("show"), 2 < e.childNodes.length && (e = e.querySelectorAll("ul li a"), Array.from(e).forEach(function (e) {
                            e.hasAttribute("aria-expanded") && e.setAttribute("aria-expanded", "false")
                        }))
                    })
                }))
            }), t.addEventListener("hide.bs.collapse", function (e) {
                e.stopPropagation();
                e = t.querySelectorAll(".collapse");
                Array.from(e).forEach(function (e) {
                    (childCollapseInstance = bootstrap.Collapse.getInstance(e)).hide()
                })
            })
        }))
    }

    function v() {
        var o, e = document.documentElement.getAttribute("data-layout"), t = sessionStorage.getItem("defaultAttribute"),
            t = JSON.parse(t);
        !t || "twocolumn" != e && "twocolumn" != t["data-layout"] || (document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = u), (o = document.createElement("ul")).innerHTML = '<a href="#" class="logo"><img src="assets/images/logo-sm.png" alt="" height="22"></a>', Array.from(document.getElementById("navbar-nav").querySelectorAll(".menu-link")).forEach(function (e) {
            o.className = "twocolumn-iconview";
            var t = document.createElement("li"), a = e;
            a.querySelectorAll("span").forEach(function (e) {
                e.classList.add("d-none")
            }), e.parentElement.classList.contains("twocolumn-item-show") && e.classList.add("active"), t.appendChild(a), o.appendChild(t), a.classList.contains("nav-link") && a.classList.replace("nav-link", "nav-icon"), a.classList.remove("collapsed", "menu-link")
        }), (e = (e = "/" == location.pathname ? "index.html" : location.pathname.substring(1)).substring(e.lastIndexOf("/") + 1)) && (t = document.getElementById("navbar-nav").querySelector('[href="' + e + '"]')) && (e = t.closest(".collapse.menu-dropdown")) && (e.classList.add("show"), e.parentElement.children[0].classList.add("active"), e.parentElement.children[0].setAttribute("aria-expanded", "true"), e.parentElement.closest(".collapse.menu-dropdown")) && (e.parentElement.closest(".collapse").classList.add("show"), e.parentElement.closest(".collapse").previousElementSibling && e.parentElement.closest(".collapse").previousElementSibling.classList.add("active"), e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) && (e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show"), e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) && e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active"), document.getElementById("two-column-menu").innerHTML = o.outerHTML, Array.from(document.querySelector("#two-column-menu ul").querySelectorAll("li a")).forEach(function (a) {
            var o = (o = "/" == location.pathname ? "index.html" : location.pathname.substring(1)).substring(o.lastIndexOf("/") + 1);
            a.addEventListener("click", function (e) {
                var t;
                (o != "/" + a.getAttribute("href") || a.getAttribute("data-bs-toggle")) && document.body.classList.contains("twocolumn-panel") && document.body.classList.remove("twocolumn-panel"), document.getElementById("navbar-nav").classList.remove("twocolumn-nav-hide"), document.querySelector(".hamburger-icon").classList.remove("open"), (e.target && e.target.matches("a.nav-icon") || e.target && e.target.matches("i")) && (null !== document.querySelector("#two-column-menu ul .nav-icon.active") && document.querySelector("#two-column-menu ul .nav-icon.active").classList.remove("active"), (e.target.matches("i") ? e.target.closest("a") : e.target).classList.add("active"), 0 < (t = document.getElementsByClassName("twocolumn-item-show")).length && t[0].classList.remove("twocolumn-item-show"), t = (e.target.matches("i") ? e.target.closest("a") : e.target).getAttribute("href").slice(1), document.getElementById(t)) && document.getElementById(t).parentElement.classList.add("twocolumn-item-show")
            }), o != "/" + a.getAttribute("href") || a.getAttribute("data-bs-toggle") || (a.classList.add("active"), document.getElementById("navbar-nav").classList.add("twocolumn-nav-hide"), document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open"))
        }), "horizontal" !== document.documentElement.getAttribute("data-layout") && ((t = new SimpleBar(document.getElementById("navbar-nav"))) && t.getContentElement(), e = new SimpleBar(document.getElementsByClassName("twocolumn-iconview")[0])) && e.getContentElement())
    }

    function h(e) {
        if (e) {
            var t = e.offsetTop, a = e.offsetLeft, o = e.offsetWidth, n = e.offsetHeight;
            if (e.offsetParent) for (; e.offsetParent;) t += (e = e.offsetParent).offsetTop, a += e.offsetLeft;
            return t >= window.pageYOffset && a >= window.pageXOffset && t + n <= window.pageYOffset + window.innerHeight && a + o <= window.pageXOffset + window.innerWidth
        }
    }

    function A() {
        feather.replace();
        var e, t, a = "/" == location.pathname ? "index.html" : location.pathname.substring(1);
        (a = a.substring(a.lastIndexOf("/") + 1)) && ("twocolumn-panel" == document.body.className && document.getElementById("two-column-menu").querySelector('[href="' + a + '"]').classList.add("active"), (a = document.getElementById("navbar-nav").querySelector('[href="' + a + '"]')) ? (a.classList.add("active"), t = ((e = a.closest(".collapse.menu-dropdown")) && e.parentElement.closest(".collapse.menu-dropdown") ? (e.classList.add("show"), e.parentElement.children[0].classList.add("active"), e.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"), e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown") && (t = e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown").getAttribute("id"), e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"), e.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.remove("twocolumn-item-show"), document.getElementById("two-column-menu").querySelector('[href="#' + t + '"]')) && document.getElementById("two-column-menu").querySelector('[href="#' + t + '"]').classList.add("active"), e.parentElement.closest(".collapse.menu-dropdown")) : (a.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"), e)).getAttribute("id"), document.getElementById("two-column-menu").querySelector('[href="#' + t + '"]') && document.getElementById("two-column-menu").querySelector('[href="#' + t + '"]').classList.add("active")) : document.body.classList.add("twocolumn-panel"))
    }

    function L() {
        var e = "/" == location.pathname ? "index.html" : location.pathname.substring(1);
        (e = e.substring(e.lastIndexOf("/") + 1)) && (e = document.getElementById("navbar-nav").querySelector('[href="' + e + '"]')) && (e.classList.add("active"), e = e.closest(".collapse.menu-dropdown")) && (e.classList.add("show"), e.parentElement.children[0].classList.add("active"), e.parentElement.children[0].setAttribute("aria-expanded", "true"), e.parentElement.closest(".collapse.menu-dropdown")) && (e.parentElement.closest(".collapse").classList.add("show"), e.parentElement.closest(".collapse").previousElementSibling && e.parentElement.closest(".collapse").previousElementSibling.classList.add("active"), e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) && (e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show"), e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) && (e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active"), "horizontal" == document.documentElement.getAttribute("data-layout")) && e.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse") && e.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active")
    }

    function h(e) {
        if (e) {
            var t = e.offsetTop, a = e.offsetLeft, o = e.offsetWidth, n = e.offsetHeight;
            if (e.offsetParent) for (; e.offsetParent;) t += (e = e.offsetParent).offsetTop, a += e.offsetLeft;
            return t >= window.pageYOffset && a >= window.pageXOffset && t + n <= window.pageYOffset + window.innerHeight && a + o <= window.pageXOffset + window.innerWidth
        }
    }

    function D() {
        var e = document.querySelectorAll(".counter-value");

        function s(e) {
            return e.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        e && Array.from(e).forEach(function (n) {
            !function e() {
                var t = +n.getAttribute("data-target"), a = +n.innerText, o = t / 250;
                o < 1 && (o = 1), a < t ? (n.innerText = (a + o).toFixed(0), setTimeout(e, 1)) : n.innerText = s(t), s(n.innerText)
            }()
        })
    }

    function B() {
        document.getElementById("two-column-menu").innerHTML = "", document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = u), document.getElementById("scrollbar").removeAttribute("data-simplebar"), document.getElementById("navbar-nav").removeAttribute("data-simplebar"), document.getElementById("scrollbar").classList.remove("h-100");
        var a = g, o = document.querySelectorAll("ul.navbar-nav > li.nav-item"), n = "", s = "";
        Array.from(o).forEach(function (e, t) {
            t + 1 === a && (s = e), a < t + 1 && (n += e.outerHTML, e.remove()), t + 1 === o.length && s.insertAdjacentHTML && s.insertAdjacentHTML("afterend", '<li class="nav-item">\t\t\t\t\t\t<a class="nav-link" href="#sidebarMore" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMore">\t\t\t\t\t\t\t<i class="ri-briefcase-2-line"></i> More\t\t\t\t\t\t</a>\t\t\t\t\t\t<div class="collapse menu-dropdown" id="sidebarMore"><ul class="nav nav-sm flex-column">' + n + "</ul></div>\t\t\t\t\t</li>")
        })
    }

    function k(e) {
        "vertical" == e ? (document.getElementById("two-column-menu").innerHTML = "", document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = u), document.getElementById("theme-settings-offcanvas") && (document.getElementById("sidebar-size").style.display = "block", document.getElementById("sidebar-view").style.display = "block", document.getElementById("sidebar-color").style.display = "block", document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "block"), document.getElementById("layout-position").style.display = "block", document.getElementById("layout-width").style.display = "block", document.getElementById("sidebar-visibility").style.display = "none"), L(),  x()) : "horizontal" == e ? (B(), document.getElementById("theme-settings-offcanvas") && (document.getElementById("sidebar-size").style.display = "none", document.getElementById("sidebar-view").style.display = "none", document.getElementById("sidebar-color").style.display = "none", document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "none"), document.getElementById("layout-position").style.display = "block", document.getElementById("layout-width").style.display = "block", document.getElementById("sidebar-visibility").style.display = "none"), L()) : "twocolumn" == e ? (document.getElementById("scrollbar").removeAttribute("data-simplebar"), document.getElementById("scrollbar").classList.remove("h-100"), document.getElementById("theme-settings-offcanvas") && (document.getElementById("sidebar-size").style.display = "none", document.getElementById("sidebar-view").style.display = "none", document.getElementById("sidebar-color").style.display = "block", document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "block"), document.getElementById("layout-position").style.display = "none", document.getElementById("layout-width").style.display = "none", document.getElementById("sidebar-visibility").style.display = "none")) : "semibox" == e && (document.getElementById("two-column-menu").innerHTML = "", document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = u), document.getElementById("theme-settings-offcanvas") && (document.getElementById("sidebar-size").style.display = "block", document.getElementById("sidebar-view").style.display = "none", document.getElementById("sidebar-color").style.display = "block", document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "block"), document.getElementById("layout-position").style.display = "block", document.getElementById("layout-width").style.display = "none", document.getElementById("sidebar-visibility").style.display = "block"), L(), x())
    }


    function x() {
        setTimeout(function () {
            var e, t, a = document.getElementById("navbar-nav");
            a && (a = a.querySelector(".nav-item .active"), 300 < (e = a ? a.offsetTop : 0)) && (t = document.getElementsByClassName("app-menu") ? document.getElementsByClassName("app-menu")[0] : "") && t.querySelector(".simplebar-content-wrapper") && setTimeout(function () {
                t.querySelector(".simplebar-content-wrapper").scrollTop = 330 == e ? e + 85 : e
            }, 0)
        }, 250)
    }



    function C(e, t, a, o) {
        var n = document.getElementById(a);
        o.setAttribute(e, t), n && document.getElementById(a).click()
    }

    function N() {
        document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || document.body.classList.remove("fullscreen-enable")
    }

    function F() {
        var t = 0;
        Array.from(document.getElementsByClassName("cart-item-price")).forEach(function (e) {
            t += parseFloat(e.innerHTML)
        }), document.getElementById("cart-item-total") && (document.getElementById("cart-item-total").innerHTML = "Rs. " + t.toFixed(2))
    }

    function G() {
        var e;
        "horizontal" !== document.documentElement.getAttribute("data-layout") && (document.getElementById("navbar-nav") && (e = new SimpleBar(document.getElementById("navbar-nav"))) && e.getContentElement(), document.getElementsByClassName("twocolumn-iconview")[0] && (e = new SimpleBar(document.getElementsByClassName("twocolumn-iconview")[0])) && e.getContentElement(), clearTimeout(c))
    }

    sessionStorage.getItem("defaultAttribute") ? ((a = {})["data-layout"] = sessionStorage.getItem("data-layout"), a["data-sidebar-size"] = sessionStorage.getItem("data-sidebar-size"), a["data-layout-mode"] = sessionStorage.getItem("data-layout-mode"), a["data-layout-width"] = sessionStorage.getItem("data-layout-width"), a["data-sidebar"] = sessionStorage.getItem("data-sidebar"), a["data-sidebar-image"] = sessionStorage.getItem("data-sidebar-image"), a["data-layout-position"] = sessionStorage.getItem("data-layout-position"), a["data-layout-style"] = sessionStorage.getItem("data-layout-style"), a["data-topbar"] = sessionStorage.getItem("data-topbar"), a["data-preloader"] = sessionStorage.getItem("data-preloader"), a["data-body-image"] = sessionStorage.getItem("data-body-image")) : (i = document.documentElement.attributes, a = {}, Array.from(i).forEach(function (e) {
        var t;
        e && e.nodeName && "undefined" != e.nodeName && (t = e.nodeName, a[t] = e.nodeValue, sessionStorage.setItem(t, e.nodeValue))
    }), sessionStorage.setItem("defaultAttribute", JSON.stringify(a)), (i = document.querySelector('.btn[data-bs-target="#theme-settings-offcanvas"]')) && i.click()), v(), o = document.getElementById("search-close-options"), s = document.getElementById("search-dropdown"), (d = document.getElementById("search-options")) && (d.addEventListener("focus", function () {
        0 < d.value.length ? (s.classList.add("show"), o.classList.remove("d-none")) : (s.classList.remove("show"), o.classList.add("d-none"))
    }), d.addEventListener("keyup", function (e) {
        var n, t;
        0 < d.value.length ? (s.classList.add("show"), o.classList.remove("d-none"), n = d.value.toLowerCase(), t = document.getElementsByClassName("notify-item"), Array.from(t).forEach(function (e) {
            var t, a, o = "";
            e.querySelector("h6") ? (t = e.getElementsByTagName("span")[0].innerText.toLowerCase(), o = (a = e.querySelector("h6").innerText.toLowerCase()).includes(n) ? a : t) : e.getElementsByTagName("span") && (o = e.getElementsByTagName("span")[0].innerText.toLowerCase()), o && (e.style.display = o.includes(n) ? "block" : "none")
        })) : (s.classList.remove("show"), o.classList.add("d-none"))
    }), o.addEventListener("click", function () {
        d.value = "", s.classList.remove("show"), o.classList.add("d-none")
    }), document.body.addEventListener("click", function (e) {
        "search-options" !== e.target.getAttribute("id") && (s.classList.remove("show"), o.classList.add("d-none"))
    })), t = document.getElementById("search-close-options"), n = document.getElementById("search-dropdown-reponsive"), e = document.getElementById("search-options-reponsive"), t && n && e && (e.addEventListener("focus", function () {
        0 < e.value.length ? (n.classList.add("show"), t.classList.remove("d-none")) : (n.classList.remove("show"), t.classList.add("d-none"))
    }), e.addEventListener("keyup", function () {
        0 < e.value.length ? (n.classList.add("show"), t.classList.remove("d-none")) : (n.classList.remove("show"), t.classList.add("d-none"))
    }), t.addEventListener("click", function () {
        e.value = "", n.classList.remove("show"), t.classList.add("d-none")
    }), document.body.addEventListener("click", function (e) {
        "search-options" !== e.target.getAttribute("id") && (n.classList.remove("show"), t.classList.add("d-none"))
    })), (i = document.querySelector('[data-toggle="fullscreen"]')) && i.addEventListener("click", function (e) {
        e.preventDefault(), document.body.classList.toggle("fullscreen-enable"), document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement ? document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen && document.webkitCancelFullScreen() : document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)
    }), document.addEventListener("fullscreenchange", N), document.addEventListener("webkitfullscreenchange", N), document.addEventListener("mozfullscreenchange", N), l = document.getElementsByTagName("HTML")[0], (m = document.querySelectorAll(".light-dark-mode")) && m.length && m[0].addEventListener("click", function (e) {
        l.hasAttribute("data-layout-mode") && "dark" == l.getAttribute("data-layout-mode") ? C("data-layout-mode", "light", "layout-mode-light", l) : C("data-layout-mode", "dark", "layout-mode-dark", l)
    }), D(),  document.getElementsByClassName("dropdown-item-cart") && (r = document.querySelectorAll(".dropdown-item-cart").length, Array.from(document.querySelectorAll("#page-topbar .dropdown-menu-cart .remove-item-btn")).forEach(function (e) {
        e.addEventListener("click", function (e) {
            r--, this.closest(".dropdown-item-cart").remove(), Array.from(document.getElementsByClassName("cartitem-badge")).forEach(function (e) {
                e.innerHTML = r
            }), F(), document.getElementById("empty-cart") && (document.getElementById("empty-cart").style.display = 0 == r ? "block" : "none"), document.getElementById("checkout-elem") && (document.getElementById("checkout-elem").style.display = 0 == r ? "none" : "block")
        })
    }), Array.from(document.getElementsByClassName("cartitem-badge")).forEach(function (e) {
        e.innerHTML = r
    }), document.getElementById("empty-cart") && (document.getElementById("empty-cart").style.display = "none"), document.getElementById("checkout-elem") && (document.getElementById("checkout-elem").style.display = "block"), F()), [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function (e) {
        return new bootstrap.Tooltip(e)
    }), [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function (e) {
        return new bootstrap.Popover(e)
    }), document.getElementById("reset-layout") && document.getElementById("reset-layout").addEventListener("click", function () {
        sessionStorage.clear(), window.location.reload()
    }), m = document.querySelectorAll("[data-toast]"), Array.from(m).forEach(function (a) {
        a.addEventListener("click", function () {
            var e = {}, t = a.attributes;
            t["data-toast-text"] && (e.text = t["data-toast-text"].value.toString()), t["data-toast-gravity"] && (e.gravity = t["data-toast-gravity"].value.toString()), t["data-toast-position"] && (e.position = t["data-toast-position"].value.toString()), t["data-toast-className"] && (e.className = t["data-toast-className"].value.toString()), t["data-toast-duration"] && (e.duration = t["data-toast-duration"].value.toString()), t["data-toast-close"] && (e.close = t["data-toast-close"].value.toString()), t["data-toast-style"] && (e.style = t["data-toast-style"].value.toString()), t["data-toast-offset"] && (e.offset = t["data-toast-offset"]), Toastify({
                newWindow: !0,
                text: e.text,
                gravity: e.gravity,
                position: e.position,
                className: "bg-" + e.className,
                stopOnFocus: !0,
                offset: {x: e.offset ? 50 : 0, y: e.offset ? 10 : 0},
                duration: e.duration,
                close: "close" == e.close,
                style: "style" == e.style ? {background: "linear-gradient(to right, #0AB39C, #405189)"} : ""
            }).showToast()
        })
    }), m = document.querySelectorAll("[data-choices]"), Array.from(m).forEach(function (e) {
        var t = {}, a = e.attributes;
        a["data-choices-groups"] && (t.placeholderValue = "This is a placeholder set in the config"), a["data-choices-search-false"] && (t.searchEnabled = !1), a["data-choices-search-true"] && (t.searchEnabled = !0), a["data-choices-removeItem"] && (t.removeItemButton = !0), a["data-choices-sorting-false"] && (t.shouldSort = !1), a["data-choices-sorting-true"] && (t.shouldSort = !0), a["data-choices-multiple-remove"] && (t.removeItemButton = !0), a["data-choices-limit"] && (t.maxItemCount = a["data-choices-limit"].value.toString()), a["data-choices-limit"] && (t.maxItemCount = a["data-choices-limit"].value.toString()), a["data-choices-editItem-true"] && (t.maxItemCount = !0), a["data-choices-editItem-false"] && (t.maxItemCount = !1), a["data-choices-text-unique-true"] && (t.duplicateItemsAllowed = !1), a["data-choices-text-disabled-true"] && (t.addItems = !1), a["data-choices-text-disabled-true"] ? new Choices(e, t).disable() : new Choices(e, t)
    }), m = document.querySelectorAll("[data-provider]"), Array.from(m).forEach(function (e) {
        var t, a, o;
        "flatpickr" == e.getAttribute("data-provider") ? (o = e.attributes, (t = {}).disableMobile = "true", o["data-date-format"] && (t.dateFormat = o["data-date-format"].value.toString()), o["data-enable-time"] && (t.enableTime = !0, t.dateFormat = o["data-date-format"].value.toString() + " H:i"), o["data-altFormat"] && (t.altInput = !0, t.altFormat = o["data-altFormat"].value.toString()), o["data-minDate"] && (t.minDate = o["data-minDate"].value.toString(), t.dateFormat = o["data-date-format"].value.toString()), o["data-maxDate"] && (t.maxDate = o["data-maxDate"].value.toString(), t.dateFormat = o["data-date-format"].value.toString()), o["data-deafult-date"] && (t.defaultDate = o["data-deafult-date"].value.toString(), t.dateFormat = o["data-date-format"].value.toString()), o["data-multiple-date"] && (t.mode = "multiple", t.dateFormat = o["data-date-format"].value.toString()), o["data-range-date"] && (t.mode = "range", t.dateFormat = o["data-date-format"].value.toString()), o["data-inline-date"] && (t.inline = !0, t.defaultDate = o["data-deafult-date"].value.toString(), t.dateFormat = o["data-date-format"].value.toString()), o["data-disable-date"] && ((a = []).push(o["data-disable-date"].value), t.disable = a.toString().split(",")), o["data-week-number"] && ((a = []).push(o["data-week-number"].value), t.weekNumbers = !0), flatpickr(e, t)) : "timepickr" == e.getAttribute("data-provider") && (a = {}, (o = e.attributes)["data-time-basic"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i"), o["data-time-hrs"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.time_24hr = !0), o["data-min-time"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.minTime = o["data-min-time"].value.toString()), o["data-max-time"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.minTime = o["data-max-time"].value.toString()), o["data-default-time"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.defaultDate = o["data-default-time"].value.toString()), o["data-time-inline"] && (a.enableTime = !0, a.noCalendar = !0, a.defaultDate = o["data-time-inline"].value.toString(), a.inline = !0), flatpickr(e, a))
    }), Array.from(document.querySelectorAll('.dropdown-menu a[data-bs-toggle="tab"]')).forEach(function (e) {
        e.addEventListener("click", function (e) {
            e.stopPropagation(), bootstrap.Tab.getInstance(e.target).show()
        })
    }),  f(), x()
}();
var mybutton = document.getElementById("back-to-top");

function scrollFunction() {
    100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ? mybutton.style.display = "block" : mybutton.style.display = "none"
}

function topFunction() {
    document.body.scrollTop = 0, document.documentElement.scrollTop = 0
}

mybutton && (window.onscroll = function () {
    scrollFunction()
});
