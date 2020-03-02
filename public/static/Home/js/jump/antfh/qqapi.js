! function(a, b, c) {
    var d = b(this[a] = this[a] || {});
    "function" == typeof define && (define.amd || define.cmd) ? define(d) : "object" == typeof module && (module.exports = d)
}("mqq", function(a, b) {
    "use strict";

    function c(a, b, c) {
        var d;
        for (d in b)(b.hasOwnProperty(d) && !(d in a) || c) && (a[d] = b[d]);
        return a
    }

    function d(a, b) {
        var c, d, e, f;
        for (a = String(a).split("."), b = String(b).split("."), c = 0, f = Math.max(a.length, b.length); f > c; c++) {
            if (d = isFinite(a[c]) && Number(a[c]) || 0, e = isFinite(b[c]) && Number(b[c]) || 0, e > d) return -1;
            if (d > e) return 1
        }
        return 0
    }

    function e(b) {
        var c = window.MQQfirebug;
        if (a.debuging && c && c.log && "pbReport" !== b.method) try {
            c.log(b)
        } catch (d) {}
    }

    function f(b, c, d, e, f) {
        if (b && c && d) {
            var g, h, i, j, k = b + "://" + c + "/" + d;
            if (e = e || [], !f || !O[f] && !window[f])
                for (f = null, h = 0, i = e.length; i > h; h++)
                    if (g = e[h], a.isObject(g) && (g = g.callbackName || g.callback), g && (O[g] || window[g])) {
                        f = g;
                        break
                    }
            f && (P[f] = {
                from: "reportAPI",
                ns: c,
                method: d,
                uri: k,
                startTime: Date.now()
            }, j = String(f).match(/__MQQ_CALLBACK_(\d+)/), j && (P[j[1]] = P[f])), C.send(k, T)
        }
    }

    function g(a) {
        var b = a.split("."),
            c = window;
        return b.forEach(function(a) {
            !c[a] && (c[a] = {}), c = c[a]
        }), c
    }

    function h(b, c, d) {
        var e, f;
        return (b = a.isFunction(b) ? b : window[b]) ? (e = i(b), f = "__MQQ_CALLBACK_" + e, window[f] = function() {
            var a = F.call(arguments);
            k(e, a, c, d)
        }, f) : void 0
    }

    function i(a) {
        var b = "" + S++;
        return a && (O[b] = a), b
    }

    function j(a) {
        var b, c, d, e = ["retCode", "retcode", "resultCode", "ret", "code", "r"];
        for (c = 0, d = e.length; d > c; c++)
            if (e[c] in a) {
                b = a[e[c]];
                break
            }
        return b
    }

    function k(d, f, g, h) {
        var i, k, l, m = a.isFunction(d) ? d : O[d] || window[d],
            n = Date.now();
        f = f || [], i = f[0], a.isUndefined(h) && (h = !0), a.isObject(i) && ("data" in i || (i.data = c({}, i)), "code" in i || (i.code = j(i) || 0), i.msg = i.msg || ""), a.isFunction(m) ? h ? setTimeout(function() {
            m.apply(null, f)
        }, 0) : m.apply(null, f) : console.log("mqqapi: not found such callback: " + d + " or the callback: " + d + " had some errors! API: " + d.name), g && (delete O[d], delete window["__MQQ_CALLBACK_" + d]), P[d] && (l = P[d], delete P[d], e({
            from: "fireCallback",
            ns: l.ns,
            method: l.method,
            ret: JSON.stringify(f),
            url: l.uri
        }), Number(d) && delete P["__MQQ_CALLBACK_" + d], i && (i.code !== b ? k = i.code : /^-?\d+$/.test(String(i)) && (k = i)), C.send(l.uri + "#callback", k, n - l.startTime))
    }

    function l(b) {
        var c = F.call(arguments, 1);
        a.android && c && c.length && c.forEach(function(b, d) {
            a.isObject(b) && "r" in b && "result" in b && (c[d] = b.result)
        }), k(b, c)
    }

    function m() {}

    function n(b, c) {
        var d = null,
            e = a.platform,
            f = b.split("."),
            h = b.lastIndexOf("."),
            i = f[f.length - 2],
            j = f[f.length - 1],
            k = g(b.substring(0, h));
        (!k[j] || a.debuging) && ((d = c[a.platform]) || "browser" === e || ((d = a.iOS && c.iOS) ? e = "iOS" : (d = a.android && c.android) && (e = "android")), d && c.supportInvoke && (R[i + "." + j] = d), k[j] = d ? d : m, c.support && c.support[e] && (Q[i + "." + j] = c.support[e]))
    }

    function o(b) {
        var c, d, e = b.split("."),
            f = e[e.length - 2] + "." + e[e.length - 1];
        return c = Q[f] || Q[b.replace("qw.", "mqq.").replace("qa.", "mqq.")], a.isObject(c) && (c = c[a.iOS ? "iOS" : a.android ? "android" : "browser"]), c ? (d = c.split("-"), 1 === d.length ? a.compare(d[0]) > -1 : a.compare(d[0]) > -1 && a.compare(d[1]) < 1) : !1
    }

    function p(c, d, f, g) {
        function h() {
            l(g, {
                r: -201,
                result: "error"
            })
        }
        e({
            from: "openURL",
            ns: d || "",
            method: f || "",
            url: c
        });
        var i, j = document.createElement("iframe");
        j.style.cssText = "display:none;width:0px;height:0px;";
        var i, k, m = (a.android && a.compare("6.2.0") >= 0 && M.test(D) ? "script" : "iframe", document.createElement("iframe"));
        m.style.cssText = "display:none;width:0px;height:0px;", m.onerror = function(a) {
            a.stopPropagation()
        }, a.iOS && (m.onload = h, m.src = c);
        var n = document.body || document.documentElement;
        return n.appendChild && n.appendChild(m), a.android && (m.onload = h, m.src = c), k = c.indexOf("mqqapi://") > -1 && a.android ? 0 : 500, setTimeout(function() {
            m && m.parentNode && m.parentNode.removeChild(m)
        }, k), i = a.__RETURN_VALUE, a.__RETURN_VALUE = b, i
    }

    function q(b, c) {
        if ("AndroidQQ" === a.platform) {
            if (a.compare("4.7.2") < 0) return !0;
            if (U[b] && a.compare(U[b]) < 0) return !0
        }
        return !1
    }

    function r(a) {
        p(a)
    }

    function s(c, d, e, g) {
        if (!c || !d || window !== window.top) return null;
        var h, j, l, m;
        if (l = F.call(arguments, 2), g = l.length && l[l.length - 1], a.isFunction(g) ? l.pop() : a.isUndefined(g) ? l.pop() : g = null, e = l[0], j = i(g), -1 === V.indexOf(d) && f("jsbridge", c, d, l, j), g && a.isObject(e) && !e.callback && (window["__MQQ_CALLBACK_AUTO_" + j] = g, e.callback = "__MQQ_CALLBACK_AUTO_" + j), q(c, d))
            if (a.compare("4.5") > -1 || /_NZ\b/.test(D)) h = "jsbridge://" + encodeURIComponent(c) + "/" + encodeURIComponent(d) + "/" + j, l.forEach(function(b) {
                a.isObject(b) && (b = JSON.stringify(b)), h += "/" + encodeURIComponent(String(b))
            }), p(h, c, d, j);
            else if (window[c] && window[c][d]) {
                if (m = window[c][d].apply(window[c], l), !g) return m;
                k(j, [m])
            } else g && k(j, [a.ERROR_NO_SUCH_METHOD]);
        else if (h = "jsbridge://" + encodeURIComponent(c) + "/" + encodeURIComponent(d), l.forEach(function(b, c) {
            a.isObject(b) && (b = JSON.stringify(b)), h += 0 === c ? "?p=" : "&p" + c + "=", h += encodeURIComponent(String(b))
        }), "pbReport" !== d && (h += "#" + j), m = p(h, c, d), a.iOS && m !== b && m.result !== b) {
            if (!g) return m.result;
            k(j, [m.result])
        }
        return null
    }

    function t(b, c, d, e) {
        var f = R[b + "." + c];
        return a.isFunction(f) ? f.apply(this, F.call(arguments, 2)) : s.apply(this, F.call(arguments))
    }

    function u(b, c, d, e, g) {
        if (!b || !c || !d) return null;
        var i, j, k = F.call(arguments);
        a.isFunction(k[k.length - 1]) ? (g = k[k.length - 1], k.pop()) : g = null, e = 4 === k.length ? k[k.length - 1] : {}, g && (e.callback_type = "javascript", i = h(g), e.callback_name = i), e.src_type = e.src_type || "web", e.version || (e.version = 1), j = b + "://" + encodeURIComponent(c) + "/" + encodeURIComponent(d) + "?" + w(e), p(j, c, d), f(b, c, d, k, i)
    }

    function v(a) {
        var b, c, d, e, f = a.indexOf("?"),
            g = a.substring(f + 1).split("&"),
            h = {};
        for (b = 0; b < g.length; b++) e = g[b], f = e.indexOf("="), -1 === f ? h[e] = "" : (c = e.substring(0, f), d = e.substring(f + 1), h[c] = decodeURIComponent(d));
        return h
    }

    function w(a) {
        var b, c, d = [];
        for (b in a) a.hasOwnProperty(b) && (b = String(b), c = String(a[b]), "" === b ? d.push(c) : d.push(b + "=" + encodeURIComponent(c)));
        return d.join("&")
    }

    function x(a, b) {
        var c, d = document.createElement("a");
        return d.href = a, d.search && (c = v(String(d.search).substring(1)), b.forEach(function(a) {
            delete c[a]
        }), d.search = "?" + w(c)), a = d.href, d = null, a
    }

    function y(a, b) {
        if ("qbrowserVisibilityChange" === a) return document.addEventListener(a, b, !1), !0;
        var c = "evt-" + a;
        return (O[c] = O[c] || []).push(b), !0
    }

    function z(a, b) {
        var c, d = "evt-" + a,
            e = O[d],
            f = !1;
        if (!e) return !1;
        if (!b) return delete O[d], !0;
        for (c = e.length - 1; c >= 0; c--) b === e[c] && (e.splice(c, 1), f = !0);
        return f
    }

    function A(a) {
        var b = "evt-" + a,
            c = O[b],
            d = F.call(arguments, 1);
        c && c.forEach(function(a) {
            k(a, d, !1)
        })
    }

    function B(b, c, d) {
        var e, g = {
            event: b,
            data: c || {},
            options: d || {}
        };
        a.android && g.options.broadcast === !1 && a.compare("5.2") <= 0 && (g.options.domains = ["localhost"], g.options.broadcast = !0), "browser" !== a.platform && (e = "jsbridge://event/dispatchEvent?p=" + encodeURIComponent(JSON.stringify(g) || ""), p(e, "event", "dispatchEvent"), f("jsbridge", "event", "dispatchEvent"))
    }
    var C, D = navigator.userAgent,
        E = window.MQQfirebug,
        F = Array.prototype.slice,
        G = Object.prototype.toString,
        H = /\b(iPad|iPhone|iPod)\b.*? OS ([\d_]+)/,
        I = /\bAndroid([^;]+)/,
        J = /\bQQ\/([\d\.]+)/,
        K = /\bIPadQQ\/([\d\.]+).*?\bQQ\/([\d\.]+)/,
        L = /\bV1_AND_SQI?_([\d\.]+)(.*? QQ\/([\d\.]+))?/,
        M = /\bTBS\/([\d]+)/,
        N = /\bTribe\/([\d\.]+)/,
        O = a.__aCallbacks || {},
        P = a.__aReports || {},
        Q = a.__aSupports || {},
        R = a.__aFunctions || {},
        S = 1,
        T = -1e5,
        U = {
            qbizApi: "5.0",
            pay: "999999",
            SetPwdJsInterface: "999999",
            GCApi: "999999",
            q_download: "999999",
            qqZoneAppList: "999999",
            qzone_app: "999999",
            qzone_http: "999999",
            qzone_imageCache: "999999",
            RoamMapJsPlugin: "999999"
        },
        V = ["pbReport", "popBack", "close", "qqVersion"];
    return E ? (a.debuging = !0, D = E.ua || D) : a.debuging = !1, c(a, function() {
        var a = {},
            b = "Object,Function,String,Number,Boolean,Date,Undefined,Null";
        return b.split(",").forEach(function(b, c) {
            a["is" + b] = function(a) {
                return G.call(a) === "[object " + b + "]"
            }
        }), a
    }()), a.iOS = H.test(D), a.android = I.test(D), a.iOS && a.android && (a.iOS = !1), a.version = "20171011005", a.QQVersion = "0", a.clientVersion = "0", a.ERROR_NO_SUCH_METHOD = "no such method", a.ERROR_PERMISSION_DENIED = "permission denied", a.compare = function(b) {
        return d(a.clientVersion, b)
    }, a.platform = function() {
        var c, e, f = "browser";
        return a.android && ((c = D.match(L)) && c.length ? (a.QQVersion = a.clientVersion = (d(c[1], c[3]) >= 0 ? c[1] : c[3]) || "0", f = "AndroidQQ") : (c = D.match(N)) && c.length && (a.clientVersion = c[1] || "0", f = "AndroidTribe"), window.JsBridge = window.JsBridge || {}, window.JsBridge.callMethod = s, window.JsBridge.callback = l, window.JsBridge.compareVersion = a.compare), a.iOS && (a.__RETURN_VALUE = b, (c = D.match(K)) && c.length ? (a.clientVersion = c[1] || "0", a.QQVersion = c[2] || a.clientVersion, f = "iPadQQ") : (c = D.match(J)) && c.length ? (a.QQVersion = a.clientVersion = c[1] || "0", f = "iPhoneQQ") : (c = D.match(N)) && c.length ? (a.clientVersion = c[1] || "0", f = "iOSTribe") : (e = s("device", "qqVersion"), e && (a.QQVersion = a.clientVersion = e, f = "iPhoneQQ")), window.iOSQQApi = a), f
    }(), S = function() {
        var a, b = 1;
        for (a in O) O.hasOwnProperty(a) && (a = Number(a), isNaN(a) || (b = Math.max(b, a)));
        return ++b
    }(), C = function() {
        function b() {
            var c, g = d,
                k = {};
            d = [], f = 0, g.length && (k.appid = h, k.typeid = i, k.releaseversion = l, k.sdkversion = a.version, k.qua = m, k.frequency = j, k.t = Date.now(), k.key = ["commandid", "resultcode", "tmcost"].join(","), g.forEach(function(a, b) {
                k[b + 1 + "_1"] = a[0], k[b + 1 + "_2"] = a[1], k[b + 1 + "_3"] = a[2]
            }), k = new String(w(k)), a.compare("4.6") >= 0 ? setTimeout(function() {
                mqq.iOS ? mqq.invokeClient("data", "pbReport", {
                    type: String(10004),
                    data: k
                }) : mqq.invokeClient("publicAccount", "pbReport", String(10004), k)
            }, 0) : (c = new Image, c.onload = function() {
                c = null
            }, c.src = "http://wspeed.qq.com/w.cgi?" + k), f = setTimeout(b, e))
        }

        function c(a, c, h) {
            var i;
            (c !== T || (c = 0, i = Math.round(Math.random() * j) % j, 1 === i)) && (d.push([a, c || 0, h || 0]), f || (g = Date.now(), f = setTimeout(b, e)))
        }
        var d = [],
            e = 500,
            f = 0,
            g = 0,
            h = 1000218,
            i = 1000280,
            j = 100,
            k = String(a.QQVersion).split(".").slice(0, 3).join("."),
            l = a.platform + "_MQQ_" + k,
            m = a.platform + a.QQVersion + "/" + a.version;
        return {
            send: c
        }
    }(), a.__aCallbacks = O, a.__aReports = P, a.__aSupports = Q, a.__aFunctions = R, a.__fireCallback = k, a.__reportAPI = f, c(a, {
        invoke: t,
        invokeClient: s,
        invokeSchema: u,
        invokeURL: r,
        build: n,
        callback: h,
        support: o,
        execGlobalCallback: l,
        addEventListener: y,
        removeEventListener: z,
        dispatchEvent: B,
        execEventCallback: A,
        mapQuery: v,
        toQuery: w,
        removeQuery: x
    }, !0), a
}),
    function(a) {
        "use strict";

        function b(a, b, c) {
            return c ? function() {
                var c = [a, b].concat(d.call(arguments));
                mqq.invoke.apply(mqq, c)
            } : function() {
                var c = d.call(arguments),
                    e = null;
                c.length && "function" == typeof c[c.length - 1] && (e = c[c.length - 1], c.pop());
                var f = l[a][b].apply(l[a], c);
                return e ? void e(f) : f
            }
        }

        function c(a, c) {
            if (c = c || 1, mqq.compare(c) < 0) return void console.info("jsbridge: version not match, apis ignored");
            for (var d in a) {
                var e = a[d];
                if (e && e.length && Array.isArray(e)) {
                    var f = window[d];
                    if (f) "object" == typeof f && f.getClass && (l[d] = f, window[d] = {});
                    else {
                        if (!k) continue;
                        window[d] = {}
                    }
                    var g = l[d];
                    f = window[d];
                    for (var h = 0, i = e.length; i > h; h++) {
                        var j = e[h];
                        f[j] || (g ? g[j] && (f[j] = b(d, j, !1)) : f[j] = b(d, j, !0))
                    }
                }
            }
        }
        var d = Array.prototype.slice,
            e = {
                QQApi: ["isAppInstalled", "isAppInstalledBatch", "startAppWithPkgName", "checkAppInstalled", "checkAppInstalledBatch", "getOpenidBatch", "startAppWithPkgNameAndOpenId"]
            },
            f = {
                QQApi: ["lauchApp"]
            },
            g = {
                publicAccount: ["close", "getJson", "getLocation", "hideLoading", "openInExternalBrowser", "showLoading", "viewAccount"]
            },
            h = {
                publicAccount: ["getMemberCount", "getNetworkState", "getValue", "open", "openEmoji", "openUrl", "setRightButton", "setValue", "shareMessage", "showDialog"],
                qqZoneAppList: ["getCurrentVersion", "getSdPath", "getWebDisplay", "goUrl", "openMsgCenter", "showDialog", "setAllowCallBackEvent"],
                q_download: ["doDownloadAction", "getQueryDownloadAction", "registerDownloadCallBackListener", "cancelDownload", "cancelNotification"],
                qzone_http: ["httpRequest"],
                qzone_imageCache: ["downloadImage", "getImageRootPath", "imageIsExist", "sdIsMounted", "updateImage", "clearImage"],
                qzone_app: ["getAllDownAppInfo", "getAppInfo", "getAppInfoBatch", "startSystemApp", "uninstallApp"]
            },
            i = {
                coupon: ["addCoupon", "addFavourBusiness", "gotoCoupon", "gotoCouponHome", "isCouponValid", "isFavourBusiness", "isFavourCoupon", "removeFavourBusiness"]
            },
            j = navigator.userAgent,
            k = /\bV1_AND_SQI?_([\d\.]+)(.*? QQ\/([\d\.]+))?/.test(j) && (mqq.compare("4.5") > -1 || /_NZ\b/.test(j)),
            l = {};
        window.JsBridge || (window.JsBridge = {}), window.JsBridge.restoreApis = c, c(e), c(f, "4.5"), k ? /\bPA\b/.test(j) || mqq.compare("4.6") >= 0 ? (c(g), c(h, "4.5"), c(i, "4.5")) : /\bQR\b/.test(j) && (c(i, "4.5"), mqq.compare("4.5") >= 0 && mqq.compare("4.6") < 0 && (window.publicAccount = {
            openUrl: function(a) {
                location.href = a
            }
        })) : c(g, "4.2")
    }(), mqq.build("mqq.app.checkAppInstalled", {
    android: function(a, b) {
        mqq.invokeClient("QQApi", "checkAppInstalled", a, b)
    },
    supportInvoke: !0,
    support: {
        android: "4.2"
    }
}), mqq.build("mqq.app.checkAppInstalledBatch", {
    android: function(a, b) {
        a = a.join("|"), mqq.invokeClient("QQApi", "checkAppInstalledBatch", a, function(a) {
            a = (a || "").split("|"), b(a)
        })
    },
    supportInvoke: !0,
    support: {
        android: "4.2"
    }
}), mqq.build("mqq.app.downloadApp", {
    iOS: function() {
        return function(a, b) {
            mqq.invokeClient("app", "downloadApp", a, b)
        }
    }(),
    android: function() {
        var a, b = {},
            c = 0,
            d = function(a) {
                if (c > 0) {
                    var d, e, f = 0,
                        g = a.length;
                    if ("object" == typeof a && g)
                        for (; d = a[f]; f++)(e = b[d.appid]) && e(d);
                    else(e = b[a.appid]) && e(a)
                }
            };
        return function(e, f) {
            !a && f && (a = !0, mqq.invokeClient("q_download", "registerDownloadCallBackListener", mqq.callback(d))), f && "function" == typeof f && (c++, b[e.appid] = f), mqq.invokeClient("q_download", "doDownloadAction", e)
        }
    }(),
    supportInvoke: !0,
    support: {
        ios: "5.9.5",
        android: "4.5"
    }
}), mqq.build("mqq.app.isAppInstalled", {
    iOS: function(a, b) {
        return mqq.invokeClient("app", "isInstalled", {
            scheme: a
        }, b)
    },
    android: function(a, b) {
        mqq.invokeClient("QQApi", "isAppInstalled", a, b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.2",
        android: "4.2"
    }
}), mqq.build("mqq.app.isAppInstalledBatch", {
    iOS: function(a, b) {
        return mqq.invokeClient("app", "batchIsInstalled", {
            schemes: a
        }, b)
    },
    android: function(a, b) {
        a = a.join("|"), mqq.invokeClient("QQApi", "isAppInstalledBatch", a, function(a) {
            var c = [];
            a = (a + "").split("|");
            for (var d = 0; d < a.length; d++) c.push(1 === parseInt(a[d]));
            b(c)
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.2",
        android: "4.2"
    }
}), mqq.build("mqq.app.launchApp", {
    iOS: function(a, b) {
        if (a) {
            a && a.name && (b = a, a = a.name, delete a.name), -1 == a.indexOf("://") && (a += "://");
            var c = a;
            b && (c = a + (a.indexOf("?") > -1 ? "&" : "?") + mqq.toQuery(b)), mqq.invokeURL(c)
        }
    },
    android: function(a) {
        a && a.name && (a = a.name), mqq.invokeClient("QQApi", "startAppWithPkgName", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.2",
        android: "4.2"
    }
}), mqq.build("mqq.app.launchAppWithTokens", {
    iOS: function(a, b) {
        return "object" == typeof a ? mqq.invokeClient("app", "launchApp", a) : mqq.invokeClient("app", "launchApp", {
            appID: a,
            paramsStr: b
        })
    },
    android: function(a) {
        mqq.compare("5.2") >= 0 ? mqq.invokeClient("QQApi", "launchAppWithTokens", a) : mqq.compare("4.6") >= 0 ? mqq.invokeClient("QQApi", "launchAppWithTokens", a.appID, a.paramsStr, a.packageName, a.flags || a.falgs || 0) : mqq.invokeClient("QQApi", "launchApp", a.appID, a.paramsStr, a.packageName)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.app.sendFunnyFace", {
    iOS: function(a) {
        mqq.invokeClient("app", "sendFunnyFace", a)
    },
    android: function(a) {
        mqq.invokeClient("qbizApi", "sendFunnyFace", a.type, a.sessionType, a.gcode, a.guin, a.faceID)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.coupon.addCoupon", {
    iOS: function(a, b, c, d, e) {
        if ("object" == typeof a) {
            var f = a;
            (f.callback = mqq.callback(b)) && mqq.invokeClient("coupon", "addCoupon", f)
        } else "function" == typeof d && (e = d, d = ""), mqq.invokeClient("coupon", "addCoupon", {
            bid: a,
            cid: b,
            sourceId: c,
            city: d || "",
            callback: mqq.callback(e)
        })
    },
    android: function(a, b) {
        var c = mqq.callback(b, !0);
        mqq.invokeClient("coupon", "addCoupon", a.bid, a.sourceId, a.cid, c)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.coupon.addFavourBusiness", {
    iOS: function(a, b, c) {
        if ("object" == typeof a) {
            var d = a;
            (d.callback = mqq.callback(b)) && mqq.invokeClient("coupon", "addFavourBusiness", d)
        } else mqq.invokeClient("coupon", "addFavourBusiness", {
            bid: a,
            sourceId: b,
            callback: mqq.callback(c)
        })
    },
    android: function(a, b) {
        var c = mqq.callback(b, !0);
        mqq.invokeClient("coupon", "addFavourBusiness", a.bid, a.sourceId, c)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.coupon.goToCouponHomePage", {
    iOS: function(a) {
        mqq.invokeClient("coupon", "goToCouponHomePage", {
            params: a
        })
    },
    android: function(a) {
        a = JSON.stringify(a || {}), mqq.invokeClient("coupon", "goToCouponHomePage", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.coupon.isFavourBusiness", {
    iOS: function(a, b, c) {
        if ("object" == typeof a) {
            var d = a;
            (d.callback = mqq.callback(b)) && mqq.invokeClient("coupon", "isFavourBusiness", d)
        } else mqq.invokeClient("coupon", "isFavourBusiness", {
            bid: a,
            sourceId: b,
            callback: mqq.callback(c)
        })
    },
    android: function(a, b) {
        mqq.invokeClient("coupon", "isFavourBusiness", a.bid, a.sourceId, b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.coupon.isFavourCoupon", {
    iOS: function(a, b, c, d) {
        if ("object" == typeof a) {
            var e = a;
            (e.callback = mqq.callback(b)) && mqq.invokeClient("coupon", "isFavourCoupon", e)
        } else mqq.invokeClient("coupon", "isFavourCoupon", {
            bid: a,
            cid: b,
            sourceId: c,
            callback: mqq.callback(d)
        })
    },
    android: function(a, b) {
        mqq.invokeClient("coupon", "isFavourCoupon", a.bid, a.cid, a.sourceId, b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.coupon.removeCoupon", {
    iOS: function(a, b, c, d) {
        if ("object" == typeof a) {
            var e = a;
            (e.callback = mqq.callback(b)) && mqq.invokeClient("coupon", "removeCoupon", e)
        } else mqq.invokeClient("coupon", "removeCoupon", {
            bid: a,
            cid: b,
            sourceId: c,
            callback: mqq.callback(d)
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6"
    }
}), mqq.build("mqq.coupon.removeFavourBusiness", {
    iOS: function(a, b, c) {
        if ("object" == typeof a) {
            var d = a;
            (d.callback = mqq.callback(b)) && mqq.invokeClient("coupon", "removeFavourBusiness", d)
        } else mqq.invokeClient("coupon", "removeFavourBusiness", {
            bid: a,
            sourceId: b,
            callback: mqq.callback(c)
        })
    },
    android: function(a, b) {
        var c = mqq.callback(b, !0);
        mqq.invokeClient("coupon", "removeFavourBusiness", a.bid, a.sourceId, c)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.data.batchFetchOpenID", {
    iOS: function(a, b) {
        var c = a.appIDs;
        mqq.data.fetchJson({
            url: "http://cgi.connect.qq.com/api/get_openids_by_appids",
            params: {
                appids: JSON.stringify(c)
            }
        }, b)
    },
    android: function(a, b) {
        var c = a.appIDs;
        mqq.data.fetchJson({
            url: "http://cgi.connect.qq.com/api/get_openids_by_appids",
            params: {
                appids: JSON.stringify(c)
            }
        }, b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.6"
    }
}), mqq.build("mqq.data.deleteH5Data", {
    iOS: function(a, b) {
        var c = mqq.callback(b || function() {});
        mqq.invokeClient("data", "deleteWebviewBizData", {
            callback: c,
            params: a
        })
    },
    android: function(a, b) {
        a = JSON.stringify(a || {}), mqq.invokeClient("publicAccount", "deleteH5Data", a, mqq.callback(b, !0))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.data.deleteH5DataByHost", {
    iOS: function(a, b) {
        var c = b ? mqq.callback(b) : null;
        mqq.invokeClient("data", "deleteWebviewBizData", {
            callback: c,
            delallhostdata: 1,
            params: a
        })
    },
    android: function(a, b) {
        a = JSON.stringify(a || {}), mqq.invokeClient("publicAccount", "deleteH5DataByHost", a, mqq.callback(b, !0))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}),
    function() {
        function a() {
            return "UID_" + ++c
        }
        var b = {},
            c = 1;
        window.clientCallback = function(a, c) {
            var d = b[c];
            if (!d) return void console.log("this getJson no callbackToken!");
            if (d.callback) {
                if (clearTimeout(d.timer), "string" == typeof a) try {
                    a = JSON.parse(a)
                } catch (e) {
                    a = null
                }
                d.callback(a, d.context || window, 200), d.callback = null
            }
        }, mqq.build("mqq.data.fetchJson", {
            iOS: function(a, b) {
                var c = a.url,
                    d = a.params || {},
                    e = a.options || {},
                    f = a.context;
                d._t = +new Date;
                var g = b ? mqq.callback(function(a, c, d) {
                    if ("string" == typeof a) try {
                        a = JSON.parse(a)
                    } catch (e) {
                        a = null
                    }
                    b(a, c, d)
                }, !0) : null;
                mqq.invokeClient("data", "fetchJson", {
                    method: e.method || "GET",
                    timeout: e.timeout || -1,
                    options: e,
                    url: c,
                    params: mqq.toQuery(d),
                    callback: g,
                    context: JSON.stringify(f)
                })
            },
            android: function(c, d) {
                var e = c.options || {},
                    f = e.method || "GET",
                    g = {
                        param: c.params,
                        method: f
                    };
                g = JSON.stringify(g);
                var h = a();
                c.callback = d, b[h] = c, e.timeout && (c.timer = setTimeout(function() {
                    c.callback && (c.callback("timeout", c.context || window, 0), c.callback = null)
                }, e.timeout)), mqq.invokeClient("publicAccount", "getJson", c.url, g, "", h)
            },
            supportInvoke: !0,
            support: {
                iOS: "4.5",
                android: "4.6"
            }
        })
    }(), mqq.build("mqq.data.getClipboard", {
    iOS: function(a) {
        var b = {},
            c = mqq.invokeClient("data", "getClipboard", b);
        a && a(c)
    },
    android: function(a) {
        var b = {};
        a && (b.callback = mqq.callback(a)), mqq.invokeClient("data", "getClipboard", b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.2",
        android: "4.7.2"
    }
}),
    function() {
        var a = function(a) {
                return function(b) {
                    a(b.friends || [])
                }
            },
            b = function(b, c) {
                c && (b.callback = mqq.callback(a(c))), mqq.invokeClient("qw_data", "getFriendInfo", b)
            };
        mqq.build("mqq.data.getFriendInfo", {
            iOS: b,
            android: b,
            supportInvoke: !0,
            support: {
                iOS: "5.1.0",
                android: "5.1.0"
            }
        })
    }(),
    function() {
        var a = function(a) {
                return function(b) {
                    var c = {};
                    b && b.remarks && (c = b.remarks), a(c)
                }
            },
            b = function(b, c) {
                c && (b.callback = mqq.callback(a(c), !1, !0)), mqq.invoke("qw_data", "getFriendRemark", b)
            };
        mqq.build("mqq.data.getFriendRemark", {
            iOS: b,
            android: b,
            supportInvoke: !0,
            support: {
                iOS: "5.8.0",
                android: "5.8.0"
            }
        })
    }(), mqq.build("mqq.data.getPageLoadStamp", {
    iOS: function(a) {
        mqq.invokeClient("data", "getPageLoadStamp", {
            callback: mqq.callback(a)
        })
    },
    android: function(a) {
        mqq.invokeClient("publicAccount", "getPageLoadStamp", mqq.callback(a))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}),
    function() {
        var a = function(a) {
                return function(b) {
                    if (mqq.android && b && void 0 === b.result) {
                        try {
                            b = JSON.parse(b)
                        } catch (c) {}
                        b = {
                            result: 0,
                            data: b,
                            message: "成功"
                        }
                    }
                    a(b)
                }
            },
            b = function(b) {
                if (mqq.compare("4.7.1") >= 0) mqq.invokeClient("qw_data", "getPerformance", a(b));
                else try {
                    common.getPerformance(a(b))
                } catch (c) {
                    b({
                        result: -1,
                        message: "该接口在手Q v4.7.1 或以上才支持！",
                        data: null
                    })
                }
            };
        mqq.build("mqq.data.getPerformance", {
            iOS: b,
            android: b,
            supportInvoke: !0,
            support: {
                iOS: "4.7.1",
                android: "4.7.1"
            }
        })
    }(), mqq.build("mqq.data.getUrlImage", {
    iOS: function(a, b) {
        var c = b ? mqq.callback(b) : null;
        mqq.invokeClient("data", "getUrlImage", {
            callback: c,
            params: a
        })
    },
    android: function(a, b) {
        a = JSON.stringify(a || {}), mqq.invokeClient("publicAccount", "getUrlImage", a, mqq.callback(b))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.data.getUserInfo", {
    iOS: function(a) {
        return mqq.invokeClient("data", "userInfo", a)
    },
    android: function(a) {
        mqq.invokeClient("data", "userInfo", {
            callback: mqq.callback(a)
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.data.getWebRunEnv", {
    iOS: function(a) {
        mqq.invokeClient("data", "getWebviewRunningEnvironment", {
            callback: mqq.callback(a)
        })
    },
    android: function(a) {
        mqq.invokeClient("data", "getWebviewRunningEnvironment", {
            callback: mqq.callback(a)
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "5.7",
        android: "6.0"
    }
}), mqq.build("mqq.data.isFollowUin", {
    iOS: function(a, b) {
        a.callback = mqq.callback(b), mqq.invokeClient("data", "isFollowUin", a)
    },
    android: function(a, b) {
        mqq.invokeClient("publicAccount", "isFollowUin", a, mqq.callback(b))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}),
    function() {
        var a, b = {},
            c = "object" == typeof tbs_bridge && "function" == typeof tbs_bridge.nativeExec,
            d = c ? tbs_bridge : null,
            e = function() {},
            f = function(a) {
                !b[a] && c && (d.nativeExec("debug", "subscribeChanged", 1, '{"numHandlers":1,"type":"' + a + '"}'), b[a] = [])
            },
            g = function(e, f) {
                var g = b[e];
                g && g.push(f), !a && c && (d.fireEvent = function(a, c) {
                    var d, e;
                    a = a || "";
                    var f = b[a];
                    if (f && f.length > 0) {
                        for (d = 0, e = f.length; e > d; d++) f[d](c);
                        b[a] = []
                    }
                }, a = !0)
            },
            h = function(a) {
                var b;
                return b = "function" == typeof a ? function(b) {
                    var c = -1,
                        d = 0;
                    "string" == typeof b && (b = JSON.parse(b)), "object" == typeof b && b.value && (c = 0, d = parseInt(b.value), d = d ? d : 0), a && a({
                        code: c,
                        time: d
                    })
                } : e
            },
            i = function(a) {
                c && (f("onfirstscreen"), g("onfirstscreen", h(a)))
            };
        mqq.build("mqq.data.onFirstScreen", {
            android: i,
            support: {
                android: "5.4.0"
            }
        })
    }(), mqq.build("mqq.data.pbReport", {
    iOS: function(a, b) {
        mqq.invokeClient("data", "pbReport", {
            type: String(a),
            data: b
        })
    },
    android: function(a, b) {
        mqq.invokeClient("publicAccount", "pbReport", String(a), b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.data.readH5Data", {
    iOS: function(a, b) {
        var c = b ? mqq.callback(b) : null;
        mqq.invokeClient("data", "readWebviewBizData", {
            callback: c,
            params: a
        })
    },
    android: function(a, b) {
        a = JSON.stringify(a || {}), mqq.invokeClient("publicAccount", "readH5Data", a, mqq.callback(function(a) {
            if (a && a.response && a.response.data) {
                var c = a.response.data;
                c = c.replace(/\\/g, ""), c = decodeURIComponent(c), a.response.data = c
            }
            b(a)
        }, !0))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.data.sendRequest", {
    iOS: function(a, b) {
        var c = a.url,
            d = a.params,
            e = a.options || {},
            f = a.context;
        d._t = +new Date, mqq.invokeClient("data", "fetchJson", {
            method: e.method || "GET",
            options: e,
            url: c,
            params: mqq.toQuery(d),
            callback: mqq.callback(b),
            context: JSON.stringify(f)
        })
    },
    android: function(a, b) {
        a.callback = mqq.callback(b), mqq.invokeClient("data", "sendRequest", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.7"
    }
}), mqq.build("mqq.data.setClipboard", {
    iOS: function(a, b) {
        mqq.invokeClient("data", "setClipboard", a), b && b(!0)
    },
    android: function(a, b) {
        b && (a.callback = mqq.callback(b)), mqq.invokeClient("data", "setClipboard", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.2",
        android: "4.7.2"
    }
}), mqq.build("mqq.data.setReturnBackResult", {
    iOS: function(a) {
        mqq.invokeClient("data", "setReturnBackResult", a)
    },
    android: function(a) {
        mqq.invokeClient("data", "setReturnBackResult", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.8",
        android: "5.8"
    }
}), mqq.build("mqq.data.setShareInfo", {
    iOS: function(a, b) {
        return a.share_url && (a.share_url = mqq.removeQuery(a.share_url, ["sid", "3g_sid"])), a.desc && (a.desc = a.desc.length > 50 ? a.desc.substring(0, 50) + "..." : a.desc), mqq.invokeClient("data", "setShareInfo", {
            params: a
        }, b)
    },
    android: function(a, b) {
        a.share_url && (a.share_url = mqq.removeQuery(a.share_url, ["sid", "3g_sid"])), a.desc && (a.desc = a.desc.length > 50 ? a.desc.substring(0, 50) + "..." : a.desc), mqq.invokeClient("QQApi", "setShareInfo", a, b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.data.setShareURL", {
    iOS: function(a, b) {
        a.url && (a.url = mqq.removeQuery(a.url, ["sid", "3g_sid"])), mqq.invokeClient("data", "setShareURL", a, b)
    },
    android: function(a, b) {
        a.url && (a.url = mqq.removeQuery(a.url, ["sid", "3g_sid"])), mqq.compare("4.6") < 0 ? b(!1) : mqq.invokeClient("QQApi", "setShareURL", a.url, b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.data.ssoRequest", {
    iOS: function(a, b) {
        a.data = JSON.stringify(a.data || {}), a.callback = mqq.callback(b), mqq.invokeClient("sso", "sendRequest", a)
    },
    android: function(a, b) {
        a.data = JSON.stringify(a.data || {}), a.callback = mqq.callback(b), mqq.invokeClient("sso", "sendRequest", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.3.2",
        android: "5.3.2"
    }
}), mqq.build("mqq.data.startSyncData", {
    iOS: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c, mqq.invokeClient("data", "startSyncData", a))
    },
    android: function(a, b) {
        var c = mqq.callback(b);
        mqq.invokeClient("qbizApi", "startSyncData", a.appID, c)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.data.stopSyncData", {
    iOS: function(a) {
        mqq.invokeClient("data", "stopSyncData", a)
    },
    android: function(a) {
        mqq.invokeClient("qbizApi", "stopSyncData", a.appID, name)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.data.writeH5Data", {
    iOS: function(a, b) {
        var c = mqq.callback(b || function() {}),
            d = a.data;
        d && "object" == typeof d && (a.data = JSON.stringify(d)), mqq.invokeClient("data", "writeWebviewBizData", {
            callback: c,
            params: a
        })
    },
    android: function(a, b) {
        var c = a.data;
        c && ("object" == typeof c && (c = JSON.stringify(c)), a.data = encodeURIComponent(c)), mqq.invokeClient("publicAccount", "writeH5Data", a, mqq.callback(b || function() {}, !0))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}),
    function() {
        var a = function(a) {
                return null === a ? "null" : void 0 === a ? "undefined" : Object.prototype.toString.call(a).slice(8, -1).toLowerCase()
            },
            b = function(b, c) {
                var d, e, f = a(b);
                return "object" === f && mqq.compare("5.8.0") >= 0 ? (d = {}, d.id = "webviewDebugLog_" + b.id, d.subid = b.subid, d.content = b.content, d.isall = !1, "string" === a(b.level) && (e = b.level.toLowerCase(), ("debug" == e || "info" == e || "error" == e) && (d.level = e)), d.level = d.level || "info", d.content = d.content ? d.content : "", d.content = d.level + "|" + d.content, "error" == d.level && (d.isall = !0), mqq.invokeClient("qw_debug", "detailLog", d)) : void 0
            };
        mqq.build("mqq.debug.detailLog", {
            iOS: b,
            android: b,
            supportInvoke: !0,
            support: {
                iOS: "5.8.0",
                android: "5.8.0"
            }
        })
    }(), mqq.build("mqq.debug.hide", {
    iOS: function(a) {
        return mqq.compare("4.7.1") >= 0 ? (null == a && (a = !0), mqq.invokeClient("qw_debug", "hide", {
            flag: a
        })) : void 0
    },
    android: function(a) {
        return mqq.compare("4.7.1") >= 0 ? (null == a && (a = !0), mqq.invokeClient("qw_debug", "hide", {
            flag: a
        })) : void 0
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.1",
        android: "4.7.1"
    }
}), mqq.build("mqq.debug.log", {
    iOS: function(a) {
        var b = "",
            c = function(a) {
                return null === a ? "null" : void 0 === a ? "undefined" : Object.prototype.toString.call(a).slice(8, -1).toLowerCase()
            },
            d = c(a);
        return b = "function" === d ? a.toString() : "string" === d ? a : "array" === d ? "[" + a.join() + "]" : JSON.stringify(a), mqq.compare("4.7.1") >= 0 ? mqq.invokeClient("qw_debug", "log", {
            msg: b
        }) : void 0
    },
    android: function(a) {
        var b = "",
            c = function(a) {
                return null === a ? "null" : void 0 === a ? "undefined" : Object.prototype.toString.call(a).slice(8, -1).toLowerCase()
            },
            d = c(a);
        b = "function" === d ? a.toString() : "string" === d ? a : "array" === d ? "[" + a.join() + "]" : JSON.stringify(a), mqq.compare("4.7.1") >= 0 && mqq.invokeClient("qw_debug", "log", {
            msg: b
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.1",
        android: "4.7.1"
    }
}), mqq.build("mqq.debug.show", {
    iOS: function(a) {
        return mqq.compare("4.7.1") >= 0 ? (null == a && (a = !0), mqq.invokeClient("qw_debug", "show", {
            flag: a
        })) : void 0
    },
    android: function(a) {
        mqq.compare("4.7.1") >= 0 && (null == a && (a = !0), mqq.invokeClient("qw_debug", "show", {
            flag: a
        }))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.1",
        android: "4.7.1"
    }
}), mqq.build("mqq.debug.start", {
    iOS: function() {
        return mqq.compare("4.7.1") >= 0 ? mqq.invokeClient("qw_debug", "start") : void 0
    },
    android: function() {
        mqq.compare("4.7.1") >= 0 && mqq.invokeClient("qw_debug", "start")
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.1",
        android: "4.7.1"
    }
}), mqq.build("mqq.debug.stop", {
    iOS: function() {
        return mqq.compare("4.7.1") >= 0 ? mqq.invokeClient("qw_debug", "stop") : void 0
    },
    android: function() {
        mqq.compare("4.7.1") >= 0 && mqq.invokeClient("qw_debug", "stop")
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.1",
        android: "4.7.1"
    }
}), mqq.build("mqq.device.connectToWiFi", {
    iOS: function(a, b) {
        b && b(mqq.ERROR_NO_SUCH_METHOD)
    },
    android: function(a, b) {
        a.callback = mqq.callback(b), a.callback && mqq.compare("5.1") >= 0 && mqq.compare("5.4") < 0 && (a.callback = "javascript:" + a.callback), mqq.invokeClient("qbizApi", "connectToWiFi", a)
    },
    supportInvoke: !0,
    support: {
        android: "4.7"
    }
}), mqq.build("mqq.device.qqVersion", {
    iOS: function(a) {
        return mqq.invokeClient("device", "qqVersion", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5"
    }
}), mqq.build("mqq.device.qqBuild", {
    iOS: function(a) {
        return mqq.invokeClient("device", "qqBuild", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5"
    }
}), mqq.build("mqq.device.getClientInfo", {
    iOS: function(a) {
        var b = {
                qqVersion: this.qqVersion(),
                qqBuild: this.qqBuild()
            },
            c = mqq.callback(a);
        return mqq.__reportAPI("web", "device", "getClientInfo", null, c), "function" != typeof a ? b : void mqq.__fireCallback(c, [b])
    },
    android: function(a) {
        if (mqq.compare("4.6") >= 0) {
            var b = a;
            a = function(a) {
                try {
                    a = JSON.parse(a)
                } catch (c) {}
                b && b(a)
            }, mqq.invokeClient("qbizApi", "getClientInfo", a)
        } else mqq.__reportAPI("web", "device", "getClientInfo"), a({
            qqVersion: mqq.QQVersion,
            qqBuild: function(a) {
                return a = a && a[1] || 0, a && a.slice(a.lastIndexOf(".") + 1) || 0
            }(navigator.userAgent.match(/\bqq\/([\d\.]+)/i))
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.6"
    }
}), mqq.build("mqq.device.systemName", {
    iOS: function(a) {
        return mqq.invokeClient("device", "systemName", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5"
    }
}), mqq.build("mqq.device.systemVersion", {
    iOS: function(a) {
        return mqq.invokeClient("device", "systemVersion", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5"
    }
}), mqq.build("mqq.device.model", {
    iOS: function(a) {
        return mqq.invokeClient("device", "model", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5"
    }
}), mqq.build("mqq.device.modelVersion", {
    iOS: function(a) {
        return mqq.invokeClient("device", "modelVersion", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5"
    }
}), mqq.build("mqq.device.getDeviceInfo", {
    iOS: function(a) {
        if (mqq.compare(4.7) >= 0) return mqq.invokeClient("device", "getDeviceInfo", a);
        var b = mqq.callback(a);
        mqq.__reportAPI("web", "device", "getClientInfo", null, b);
        var c = {
            isMobileQQ: this.isMobileQQ(),
            systemName: this.systemName(),
            systemVersion: this.systemVersion(),
            model: this.model(),
            modelVersion: this.modelVersion()
        };
        return "function" != typeof a ? c : void mqq.__fireCallback(b, [c])
    },
    android: function(a) {
        if (mqq.compare("4.6") >= 0) {
            var b = a;
            a = function(a) {
                try {
                    a = JSON.parse(a)
                } catch (c) {}
                b && b(a)
            }, mqq.invokeClient("qbizApi", "getDeviceInfo", a)
        } else {
            var c = navigator.userAgent;
            mqq.__reportAPI("web", "device", "getClientInfo"), a({
                isMobileQQ: !0,
                systemName: "android",
                systemVersion: function(a) {
                    return a && a[1] || 0
                }(c.match(/\bAndroid ([\d\.]+)/i)),
                model: function(a) {
                    return a && a[1] || null
                }(c.match(/;\s([^;]+)\s\bBuild\/\w+/i))
            })
        }
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.5"
    }
}),
    function() {
        function a(a, c) {
            return "string" == typeof a && -1 != a.indexOf("Permission denied") ? c && c(a) : ("string" == typeof a && /^{.*?}$/.test(a) && (a = JSON.parse(a)), a && "radio" in a && (1 === a.type ? a.radio = "wifi" : a.type >= 2 ? a.radio = b[a.radio] || a.radio : a.radio = "unknown"), void(c && c(a)))
        }
        var b = {
            CTRadioAccessTechnologyGPRS: "gprs",
            CTRadioAccessTechnologyEdge: "edge",
            CTRadioAccessTechnologyWCDMA: "wcdma",
            CTRadioAccessTechnologyHSDPA: "hsdpa",
            CTRadioAccessTechnologyCDMA1x: "cdma",
            CTRadioAccessTechnologyCDMAEVDORev0: "evdo0",
            CTRadioAccessTechnologyCDMAEVDORevA: "evdoa",
            CTRadioAccessTechnologyCDMAEVDORevB: "evdob",
            CTRadioAccessTechnologyeHRPD: "ehrpd",
            CTRadioAccessTechnologyLTE: "lte",
            NETWORK_TYPE_GPRS: "gprs",
            NETWORK_TYPE_EDGE: "edge",
            NETWORK_TYPE_CDMA: "cdma",
            NETWORK_TYPE_1xRTT: "1xrtt",
            NETWORK_TYPE_EVDO_0: "evdo0",
            NETWORK_TYPE_EVDO_A: "evdoa",
            NETWORK_TYPE_EVDO_B: "evdob",
            NETWORK_TYPE_IDEN: "iden",
            NETWORK_TYPE_UMTS: "umts",
            NETWORK_TYPE_HSDPA: "hsdpa",
            NETWORK_TYPE_HSUPA: "hsupa",
            NETWORK_TYPE_HSPA: "hspa",
            NETWORK_TYPE_EHRPD: "ehrpd",
            NETWORK_TYPE_HSPAP: "hspap",
            NETWORK_TYPE_LTE: "lte",
            NETWORK_TYPE_WIFI: "wifi",
            NETWORK_TYPE_UNKNOWN: "unknown"
        };
        mqq.build("mqq.device.getNetworkInfo", {
            iOS: function(b) {
                mqq.invokeClient("device", "getNetworkInfo", {
                    callback: mqq.callback(function(c) {
                        a(c, b)
                    }, !1, !0)
                })
            },
            android: function(b) {
                mqq.invokeClient("qbizApi", "getNetworkInfo", function(c) {
                    a(c, b)
                })
            },
            supportInvoke: !0,
            support: {
                iOS: "5.2",
                android: "5.2"
            }
        })
    }(), mqq.build("mqq.device.getNetworkType", {
    iOS: function(a) {
        var b = mqq.invokeClient("device", "networkStatus");
        return b = Number(b), "function" != typeof a ? b : void mqq.__fireCallback(a, [b])
    },
    android: function(a) {
        mqq.compare("4.6") >= 0 ? mqq.invokeClient("qbizApi", "getNetworkType", a) : mqq.invokeClient("publicAccount", "getNetworkState", function(b) {
            var c = {
                    "-1": 0,
                    0: 3,
                    1: 1
                },
                d = b in c ? c[b] : 4;
            a(d)
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.6"
    }
}), mqq.build("mqq.device.networkStatus", {
    iOS: mqq.device.getNetworkType,
    supportInvoke: !0,
    support: {
        iOS: "4.5"
    }
}), mqq.build("mqq.device.networkType", {
    iOS: mqq.device.getNetworkType,
    supportInvoke: !0,
    support: {
        iOS: "4.5"
    }
}), mqq.build("mqq.device.getWebViewType", {
    iOS: function(a) {
        return mqq.invokeClient("device", "webviewType", a)
    },
    android: function(a) {
        var b = 1,
            c = navigator.userAgent;
        return /\bPA\b/.test(c) ? (b = 5, /\bCoupon\b/.test(c) ? b = 2 : /\bMyCoupon\b/.test(c) && (b = 3)) : /\bQR\b/.test(c) && (b = 4), mqq.__reportAPI("web", "device", "getWebViewType"), a ? a(b) : b
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.device.webviewType", {
    iOS: mqq.device.getWebViewType,
    supportInvoke: !0,
    support: {
        iOS: "4.6"
    }
}), mqq.build("mqq.device.isMobileQQ", {
    iOS: function(a) {
        var b = ["iPhoneQQ", "iPadQQ"].indexOf(mqq.platform) > -1;
        return a ? a(b) : b
    },
    android: function(a) {
        var b = "AndroidQQ" === mqq.platform;
        return a ? a(b) : b
    },
    browser: function(a) {
        var b = ["iPhoneQQ", "iPadQQ", "AndroidQQ"].indexOf(mqq.platform) > -1;
        return a ? a(b) : b
    },
    supportSync: !0,
    supportInvoke: !0,
    support: {
        iOS: "4.2",
        android: "4.2"
    }
}), mqq.build("mqq.device.setScreenStatus", {
    iOS: function(a, b) {
        a = a || {}, a.callback = mqq.callback(b), mqq.invokeClient("device", "setScreenStatus", a)
    },
    android: function(a, b) {
        a = a || {}, a.callback = mqq.callback(b), mqq.invokeClient("device", "setScreenStatus", a)
    },
    supportInvoke: !0,
    support: {
        android: "5.0"
    }
}), mqq.build("mqq.event.dispatchEvent", {
    iOS: function() {
        mqq.invokeClient("event", "dispatchEvent")
    },
    android: function() {
        mqq.invokeClient("event", "dispatchEvent")
    },
    supportInvoke: !0,
    support: {
        iOS: "5.0",
        android: "5.0"
    }
}), mqq.build("mqq.media.getLocalImage", {
    iOS: function(a, b) {
        a.callback = mqq.callback(b), mqq.invokeClient("media", "getLocalImage", a)
    },
    android: function(a, b) {
        a.callback = mqq.callback(b), mqq.invokeClient("media", "getLocalImage", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.2",
        android: "4.7.2"
    }
}), mqq.build("mqq.media.getPicture", {
    iOS: function(a, b) {
        !a.outMaxWidth && a.maxWidth && (a.outMaxWidth = a.maxWidth, delete a.maxWidth), !a.outMaxHeight && a.maxHeight && (a.outMaxHeight = a.maxHeight, delete a.maxHeight), a.callback = mqq.callback(function(a, c) {
            c && c.forEach && c.forEach(function(a, b) {
                "string" == typeof a && (c[b] = {
                    data: a,
                    imageID: "",
                    match: 0
                })
            }), b && b(a, c)
        }, !0), mqq.invokeClient("media", "getPicture", a)
    },
    android: function(a, b) {
        a.callback = mqq.callback(b), mqq.invokeClient("media", "getPicture", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.media.playLocalSound", {
    iOS: function(a) {
        mqq.invokeClient("sensor", "playLocalSound", a)
    },
    android: function(a) {
        mqq.invokeClient("qbizApi", "playVoice", a.bid, a.url)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.media.preloadSound", {
    iOS: function(a, b) {
        a.callback = mqq.callback(b, !0), mqq.invokeClient("sensor", "preloadSound", a)
    },
    android: function(a, b) {
        mqq.invokeClient("qbizApi", "preloadVoice", a.bid, a.url, mqq.callback(b, !0))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.media.saveImage", {
    iOS: function(a, b) {
        a.callback = mqq.callback(b, !1), mqq.invokeClient("media", "saveImage", a)
    },
    android: function(a, b) {
        a.callback = mqq.callback(b, !1), mqq.invokeClient("media", "saveImage", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.1",
        android: "5.2"
    }
}), mqq.build("mqq.media.showPicture", {
    iOS: function(a, b) {
        mqq.invokeClient("troopNotice", "showPicture", a, b)
    },
    android: function(a, b) {
        mqq.invokeClient("troopNotice", "showPicture", a, b)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.0",
        android: "5.0"
    }
}), mqq.build("mqq.nfc.addTagDiscoveredListener", {
    android: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.addEventListener("tagDiscovered", b)
    },
    iOS: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.addEventListener("tagDiscovered", b)
    },
    supportInvoke: !0,
    support: {
        android: "6.5.5",
        iOS: "6.5.5"
    }
}), mqq.build("mqq.nfc.addTagDiscoveredListener", {
    android: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.addEventListener("tagDiscovered", b)
    },
    iOS: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.addEventListener("tagDiscovered", b)
    },
    supportInvoke: !0,
    support: {
        android: "6.5.5",
        iOS: "6.5.5"
    }
}), mqq.build("mqq.nfc.getNfcStatus", {
    android: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("nfc", "getNfcStatus", JSON.stringify(a), b)
    },
    iOS: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("nfc", "getNfcStatus", JSON.stringify(a), b)
    },
    supportInvoke: !0,
    support: {
        android: "6.5.5",
        iOS: "6.5.5"
    }
}), mqq.build("mqq.nfc.nfcInit", {
    android: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("nfc", "nfcInit", JSON.stringify(a), b)
    },
    iOS: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("nfc", "nfcInit", JSON.stringify(a), b)
    },
    supportInvoke: !0,
    support: {
        android: "6.5.5",
        iOS: "6.5.5"
    }
}), mqq.build("mqq.nfc.nfcTranceive", {
    android: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("nfc", "nfcTranceive", JSON.stringify(a), b)
    },
    iOS: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("nfc", "nfcTranceive", JSON.stringify(a), b)
    },
    supportInvoke: !0,
    support: {
        android: "6.5.5",
        iOS: "6.5.5"
    }
}), mqq.build("mqq.nfc.nfcUnInit", {
    android: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("nfc", "nfcUnInit", JSON.stringify(a), b)
    },
    iOS: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("nfc", "nfcUnInit", JSON.stringify(a), b)
    },
    supportInvoke: !0,
    support: {
        android: "6.5.5",
        iOS: "6.5.5"
    }
}), mqq.build("mqq.offline.batchCheckUpdate", {
    iOS: function(a, b) {
        b && (a.callback = mqq.callback(b)), mqq.invokeClient("offline", "batchCheckUpdate", a)
    },
    android: function(a, b) {
        a.callback = mqq.callback(function(a) {
            try {
                a = JSON.parse(a)
            } catch (c) {
                try {
                    a = new Function("return " + a)()
                } catch (c) {}
            }
            b && b(a || {})
        }), mqq.invokeClient("offline", "batchCheckUpdate", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.4",
        android: "5.4"
    }
}), mqq.build("mqq.offline.checkUpdate", {
    iOS: function(a, b) {
        var c = mqq.callback(function(a) {
            b && b(a.data)
        });
        c && (a.callback = c, mqq.invokeClient("offline", "checkUpdate", a))
    },
    android: function(a, b) {
        mqq.invokeClient("qbizApi", "checkUpdate", a.bid, mqq.callback(function(a) {
            b && b(Array.isArray(a.data) ? a.data[0] : a)
        }))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.offline.clearCache", {
    iOS: function(a, b) {
        b && (a.callback = mqq.callback(b)), mqq.invokeClient("offline", "clearCache", a)
    },
    android: function(a, b) {
        var c = b;
        b = function(a) {
            try {
                a = JSON.parse(a)
            } catch (b) {
                try {
                    a = new Function("return " + a)()
                } catch (b) {}
            }
            c && c(a || {})
        }, mqq.invokeClient("offline", "clearCache", a, b)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.4",
        android: "5.4"
    }
}), mqq.build("mqq.offline.disableCache", {
    iOS: function(a) {
        mqq.invokeClient("offline", "disableCache", {
            callback: mqq.callback(a)
        })
    },
    android: function(a) {
        var b = a;
        a = function(a) {
            try {
                a = JSON.parse(a)
            } catch (c) {
                try {
                    a = new Function("return " + a)()
                } catch (c) {}
            }
            b && b(a || {})
        }, mqq.invokeClient("offline", "disableCache", {}, a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.4",
        android: "5.4"
    }
}), mqq.build("mqq.offline.downloadUpdate", {
    iOS: function(a, b) {
        var c = mqq.callback(b, !1);
        c && (a.callback = c, mqq.invokeClient("offline", "downloadUpdate", a))
    },
    android: function(a, b) {
        var c = mqq.callback(b, !1);
        a.fileSize && a.fileSize > 0 ? mqq.invokeClient("qbizApi", "forceUpdate", a.bid, a.url, a.fileSize, c) : mqq.invokeClient("qbizApi", "forceUpdate", a.bid, a.url, c)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.offline.isCached", {
    iOS: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c, mqq.invokeClient("offline", "isCached", a))
    },
    android: function(a, b) {
        mqq.invokeClient("qbizApi", "isCached", a.bid, mqq.callback(b))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.pay.enablePay", {
    iOS: function(a) {
        mqq.invokeClient("pay", "enablePay", {
            params: a
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6"
    }
}), mqq.build("mqq.pay.pay", {
    iOS: function(a, b) {
        var c = b ? mqq.callback(b) : null;
        mqq.invokeClient("pay", "pay", {
            params: a,
            callback: c
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6"
    }
}), mqq.build("mqq.redpoint.getAppInfo", {
    iOS: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("redpoint", "getAppInfo", a)
    },
    android: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("redpoint", "getAppInfo", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}),
    function() {
        function a(a) {
            var b = null;
            if (e === !1 && (e = "" == location.search ? "" == location.hash ? "" : location.hash.substring(1) : location.search.substring(1), e = e.split("&"), e.length > 0))
                for (var c = 0; c < e.length; c++)
                    if (b = e[c], b = b.split("="), b.length > 1) try {
                        f[b[0]] = decodeURIComponent(b[1])
                    } catch (d) {
                        f[b[0]] = ""
                    }
            return "undefined" != typeof f[a] ? f[a] : ""
        }

        function b() {
            return "UID_" + ++m
        }

        function c(a, b) {
            var c = {
                    sid: g,
                    appid: a.substring(a.lastIndexOf(".") + 1),
                    platid: h,
                    qqver: i,
                    format: "json",
                    _: (new Date).getTime()
                },
                d = "get_new_msg_cnt";
            try {
                Zepto.ajax({
                    type: "get",
                    url: j + d,
                    dataType: "json",
                    data: c,
                    timeout: 1e4,
                    success: function(a) {
                        var c = {
                            ret: a.ecode,
                            count: 0
                        };
                        0 == a.ecode && (c.count = a.new_msg_cnt), l[b].call(null, c), delete l[b]
                    },
                    error: function() {
                        l[b].call(null, {
                            ret: -1,
                            list: []
                        }), delete l[b]
                    }
                })
            } catch (e) {
                l[b].call(null, {
                    ret: -2,
                    list: []
                }), delete l[b]
            }
        }

        function d(a, b) {
            if (0 == a.code) {
                var c = {
                        ret: a.code,
                        count: 0
                    },
                    d = a.data.buffer;
                if (d = "object" != typeof d && "" != d ? JSON.parse(d) : d, "undefined" != typeof d.msg)
                    for (var e in d.msg) 1 == d.msg[e].stat && c.count++;
                l[b].call(null, c)
            } else l[b].call(null, {
                ret: a.code,
                list: []
            });
            delete l[b]
        }
        var e = !1,
            f = {},
            g = a("sid"),
            h = mqq.iOS ? 110 : mqq.android ? 109 : 0,
            i = mqq.QQVersion ? mqq.QQVersion : "",
            j = "http://msg.vip.qq.com/cgi-bin/",
            k = function() {
                return mqq.compare("4.7") >= 0
            }(),
            l = {},
            m = 1;
        mqq.build("mqq.redpoint.getNewMsgCnt", {
            iOS: function(a, e) {
                appid = String(a.path);
                var f = b();
                if (l[f] = e, k) mqq.redpoint.getAppInfo(a, function(a) {
                    d(a, f)
                });
                else {
                    if (!Zepto) return void("function" == typeof e ? e({
                        ret: -1e4,
                        count: 0
                    }) : null);
                    c(appid, f)
                }
            },
            android: function(a, e) {
                appid = String(a.path);
                var f = b();
                if (l[f] = e, k) mqq.redpoint.getAppInfo(a, function(a) {
                    d(a, f)
                });
                else {
                    if (!Zepto) return void("function" == typeof e ? e({
                        ret: -1e4,
                        count: 0
                    }) : null);
                    c(appid, f)
                }
            },
            supportInvoke: !0,
            support: {
                iOS: "4.5",
                android: "4.5"
            }
        })
    }(),
    function() {
        function a(a) {
            var b = null;
            if (e === !1 && (e = "" == location.search ? "" == location.hash ? "" : location.hash.substring(1) : location.search.substring(1), e = e.split("&"), e.length > 0))
                for (var c = 0; c < e.length; c++)
                    if (b = e[c], b = b.split("="), b.length > 1) try {
                        f[b[0]] = decodeURIComponent(b[1])
                    } catch (d) {
                        f[b[0]] = ""
                    }
            return "undefined" != typeof f[a] ? f[a] : ""
        }

        function b() {
            return "UID_" + ++m
        }

        function c(a, b) {
            var c = {
                    sid: g,
                    appid: a.substring(a.lastIndexOf(".") + 1),
                    platid: h,
                    qqver: i,
                    format: "json",
                    _: (new Date).getTime()
                },
                d = "read_msg";
            try {
                Zepto.ajax({
                    type: "get",
                    url: j + d,
                    dataType: "json",
                    data: c,
                    timeout: 1e4,
                    success: function(a) {
                        var c = {
                            ret: a.ecode,
                            list: []
                        };
                        if (0 == a.ecode) {
                            var d = a.msg,
                                e = [];
                            for (var f in d) e.push({
                                content: d[f].content ? d[f].content : "",
                                link: d[f].link ? d[f].link : "",
                                img: d[f].img ? d[f].img : "",
                                pubTime: d[f].time ? d[f].time : "",
                                title: d[f].title ? d[f].title : "",
                                src: d[f].src ? d[f].src : "",
                                ext1: d[f].ext1 ? d[f].ext1 : "",
                                ext2: d[f].ext2 ? d[f].ext2 : "",
                                ext3: d[f].ext3 ? d[f].ext3 : "",
                                id: f
                            });
                            c.list = e
                        }
                        l[b].call(null, c), delete l[b]
                    },
                    error: function() {
                        l[b].call(null, {
                            ret: -1,
                            list: []
                        }), delete l[b]
                    }
                })
            } catch (e) {
                l[b].call(null, {
                    ret: -2,
                    list: []
                }), delete l[b]
            }
        }

        function d(a, b) {
            if (0 == a.code) {
                var c = {
                        ret: a.code,
                        list: []
                    },
                    d = a.data.buffer,
                    e = [];
                if (d = "object" != typeof d && "" != d ? JSON.parse(d) : d, "undefined" != typeof d.msg) {
                    for (var f in d.msg) 1 == d.msg[f].stat && (e.push({
                        content: d.msg[f].content ? d.msg[f].content : "",
                        link: d.msg[f].link ? d.msg[f].link : "",
                        img: d.msg[f].img ? d.msg[f].img : "",
                        pubTime: d.msg[f].time ? d.msg[f].time : "",
                        title: d.msg[f].title ? d.msg[f].title : "",
                        src: d.msg[f].src ? d.msg[f].src : "",
                        ext1: d.msg[f].ext1 ? d.msg[f].ext1 : "",
                        ext2: d.msg[f].ext2 ? d.msg[f].ext2 : "",
                        ext3: d.msg[f].ext3 ? d.msg[f].ext3 : "",
                        id: f
                    }), d.msg[f].stat = 2);
                    if (a.data.buffer = JSON.stringify(d), e.length > 0) {
                        c.list = e, mqq.redpoint.setAppInfo({
                            appInfo: a.data
                        }, function(a) {
                            console.log(JSON.stringify(a))
                        });
                        var k = a.data.appID,
                            m = {
                                sid: g,
                                appid: k,
                                platid: h,
                                qqver: i,
                                format: "json",
                                _: (new Date).getTime()
                            },
                            n = "read_msg";
                        try {
                            Zepto.ajax({
                                type: "get",
                                url: j + n,
                                dataType: "json",
                                data: m,
                                timeout: 1e4,
                                success: function(a) {},
                                error: function() {}
                            })
                        } catch (o) {}
                    }
                }
                l[b].call(null, c)
            } else l[b].call(null, {
                ret: a.code,
                list: []
            });
            delete l[b]
        }
        var e = !1,
            f = {},
            g = a("sid"),
            h = mqq.iOS ? 110 : mqq.android ? 109 : 0,
            i = mqq.QQVersion ? mqq.QQVersion : "",
            j = "http://msg.vip.qq.com/cgi-bin/",
            k = function() {
                return mqq.compare("4.7") >= 0
            }(),
            l = {},
            m = 1;
        mqq.build("mqq.redpoint.getNewMsgList", {
            iOS: function(a, e) {
                appid = String(a.path);
                var f = b();
                if (l[f] = e, k) mqq.redpoint.getAppInfo(a, function(a) {
                    d(a, f)
                });
                else {
                    if (!Zepto) return void("function" == typeof e ? e({
                        ret: -1e4,
                        count: 0
                    }) : null);
                    c(appid, f)
                }
            },
            android: function(a, e) {
                appid = String(a.path);
                var f = b();
                if (l[f] = e, k) mqq.redpoint.getAppInfo(a, function(a) {
                    d(a, f)
                });
                else {
                    if (!Zepto) return void("function" == typeof e ? e({
                        ret: -1e4,
                        count: 0
                    }) : null);
                    c(appid, f)
                }
            },
            supportInvoke: !0,
            support: {
                iOS: "4.5",
                android: "4.5"
            }
        })
    }(), mqq.build("mqq.redpoint.getRedPointShowInfo", {
    iOS: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("redpoint", "getRedPointShowInfo", a)
    },
    android: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("redpoint", "getRedPointShowInfo", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.redpoint.isEnterFromRedPoint", {
    iOS: function(a, b) {
        var c = mqq.callback(b, !0);
        c && (a.callback = c), mqq.invokeClient("redpoint", "isEnterFromRedPoint", a)
    },
    android: function(a, b) {
        var c = mqq.callback(b, !0);
        c && (a.callback = c), mqq.invokeClient("redpoint", "isEnterFromRedPoint", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.4",
        android: "5.4"
    }
}),
    function() {
        var a = function(a, b) {
            "function" != typeof b && (b = function(a) {});
            for (var c = ["path", "service_type", "service_id", "act_id", "obj_id", "pay_amt"], d = 0, e = c.length; e > d; ++d)
                if ("undefined" == typeof a[c[d]]) return b({
                    code: -1,
                    errorMessage: "params invalid"
                }), b = null, !1;
            mqq.redpoint.isEnterFromRedPoint({
                path: a.path
            }, function(c) {
                0 == c.code && 1 == c.data ? (b && (a.callback = mqq.callback(b, !0)), mqq.invokeClient("redpoint", "reportBusinessRedTouch", a)) : (b({
                    code: -1,
                    errorMessage: c.errorMessage
                }), a = null, b = null)
            })
        };
        mqq.build("mqq.redpoint.reportBusinessRedTouch", {
            iOS: a,
            android: a,
            supportInvoke: !0,
            support: {
                iOS: "5.4",
                android: "5.4"
            }
        })
    }(), mqq.build("mqq.redpoint.reportRedTouch", {
    iOS: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("redpoint", "reportRedTouch", a)
    },
    android: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("redpoint", "reportRedTouch", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.redpoint.setAppInfo", {
    iOS: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("redpoint", "setAppInfo", a)
    },
    android: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("redpoint", "setAppInfo", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.sensor.getLocation", {
    iOS: function(a) {
        var b = arguments[arguments.length - 1],
            c = "object" == typeof a ? a : {};
        return "function" == typeof b && (c.callback = mqq.callback(b)), mqq.invokeClient("data", "queryCurrentLocation", c)
    },
    android: function(a) {
        var b = arguments[arguments.length - 1],
            c = "object" == typeof a ? a : {},
            d = mqq.callback(function(a) {
                var c = -1,
                    d = null,
                    e = null;
                a && "null" !== a && (a = (a + "").split(","), 2 === a.length && (c = 0, d = parseFloat(a[0] || 0), e = parseFloat(a[1] || 0))), b(c, e, d)
            }, !0);
        "function" == typeof b && (c.callback = d), mqq.invokeClient("publicAccount", "getLocation", mqq.compare("5.5") > -1 ? c : d)
    },
    browser: function() {
        var a = arguments[arguments.length - 1];
        navigator.geolocation ? navigator.geolocation.getCurrentPosition(function(b) {
            var c = b.coords.latitude,
                d = b.coords.longitude;
            a(0, c, d)
        }, function() {
            a(-1)
        }) : a(-1)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.6",
        browser: "0"
    }
}), mqq.build("mqq.sensor.getRealLocation", {
    iOS: function(a, b) {
        var c = b ? mqq.callback(b) : null;
        return mqq.invokeClient("data", "getOSLocation", {
            params: a,
            callback: c
        })
    },
    android: function(a, b) {
        a = JSON.stringify(a || {}), mqq.invokeClient("publicAccount", "getRealLocation", a, mqq.callback(b, !0))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.sensor.getSensorStatus", {
    iOS: function(a, b) {
        a = a || {
            type: "gps"
        }, a.callbackName = mqq.callback(b), mqq.invokeClient("sensor", "getSensorStatus", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7"
    }
}), mqq.build("mqq.sensor.startAccelerometer", {
    iOS: function(a) {
        var b = mqq.callback(a, !1, !0);
        b && mqq.invokeClient("sensor", "startAccelerometer", {
            callback: b
        })
    },
    android: function(a) {
        var b = mqq.callback(a, !1, !0);
        mqq.invokeClient("qbizApi", "startAccelerometer", b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.sensor.startCompass", {
    iOS: function(a) {
        var b = mqq.callback(a, !1, !0);
        b && mqq.invokeClient("sensor", "startCompass", {
            callback: b
        })
    },
    android: function(a) {
        var b = mqq.callback(a, !1, !0);
        mqq.invokeClient("qbizApi", "startCompass", b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.sensor.startListen", {
    iOS: function(a) {
        var b = mqq.callback(a, !1, !0);
        b && mqq.invokeClient("sensor", "startListen", {
            callback: b
        })
    },
    android: function(a) {
        var b = mqq.callback(a, !1, !0);
        mqq.invokeClient("qbizApi", "startListen", b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.sensor.stopAccelerometer", {
    iOS: function() {
        mqq.invokeClient("sensor", "stopAccelerometer")
    },
    android: function() {
        mqq.invokeClient("qbizApi", "stopAccelerometer")
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.sensor.stopCompass", {
    iOS: function() {
        mqq.invokeClient("sensor", "stopCompass")
    },
    android: function() {
        mqq.invokeClient("qbizApi", "stopCompass")
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.sensor.stopListen", {
    iOS: function() {
        mqq.invokeClient("sensor", "stopListen")
    },
    android: function() {
        mqq.invokeClient("qbizApi", "stopListen")
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.sensor.vibrate", {
    iOS: function(a) {
        a = a || {}, mqq.invokeClient("sensor", "vibrate", a)
    },
    android: function(a) {
        a = a || {}, mqq.invokeClient("qbizApi", "phoneVibrate", a.time)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.tenpay.buyGoods", {
    android: function(a, b) {
        mqq.invokeClient("pay", "buyGoods", JSON.stringify(a), b)
    },
    iOS: function(a, b) {
        mqq.invokeClient("pay", "buyGoods", JSON.stringify(a), b)
    },
    supportInvoke: !0,
    support: {
        android: "4.6.1",
        iOS: "6.5.0"
    }
}), mqq.build("mqq.tenpay.isOpenSecurityPay", {
    android: function(a, b) {
        var a = {};
        b && (a.callback = mqq.callback(b)), mqq.invokeClient("qw_charge", "qqpimsecure_safe_isopen_securitypay", a)
    },
    supportInvoke: !0,
    support: {
        android: "5.3.0"
    }
}), mqq.build("mqq.tenpay.openService", {
    iOS: function(a, b) {
        mqq.invokeClient("pay", "openService", JSON.stringify(a), b)
    },
    android: function(a, b) {
        mqq.invokeClient("pay", "openService", JSON.stringify(a), b)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.7",
        android: "4.6.1"
    }
}), mqq.build("mqq.tenpay.openTenpayView", {
    iOS: function(a, b) {
        var c = b ? mqq.callback(b) : null;
        mqq.invokeClient("pay", "openTenpayView", {
            params: a,
            callback: c
        })
    },
    android: function(a, b) {
        mqq.invokeClient("pay", "openTenpayView", JSON.stringify(a), b)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6.1",
        android: "4.6.1"
    }
}),
function() {
    var a = function(a) {
        return function(b, c, d) {
            if (d) try {
                return void(a && a(JSON.parse(d)))
            } catch (e) {}
            b = Number(b);
            var f = {
                resultCode: b,
                retmsg: "",
                data: {}
            };
            if (0 === b) {
                var g = c;
                c = mqq.mapQuery(c), c.sp_data = g, c.attach && 0 === c.attach.indexOf("{") && (c.attach = JSON.parse(c.attach)), c.time_end && (c.pay_time = c.time_end), f.data = c
            } else 1 === b || -1 === b ? (f.retmsg = "用户主动放弃支付", f.resultCode = -1) : f.retmsg = c;
            a && a(f)
        }
    };
    mqq.build("mqq.tenpay.pay", {
        iOS: function(b, c) {
            b.order_no = b.tokenId || b.tokenID || b.prepayId, b.app_info = b.app_info || b.appInfo, mqq.compare("4.6.2") >= 0 ? mqq.invokeSchema("mqqapi", "wallet", "pay", b, a(c)) : mqq.invokeSchema("mqqapiwallet", "wallet", "pay", b, a(c))
        },
        android: function(b, c) {
            b.tokenId = b.tokenId || b.tokenID || b.prepayId, b.app_info = b.app_info || b.appInfo, mqq.compare("4.6.1") >= 0 ? mqq.invokeClient("pay", "pay", JSON.stringify(b), c) : mqq.invokeSchema("mqqapi", "tenpay", "pay", b, a(c))
        },
        supportInvoke: !0,
        support: {
            iOS: "4.6.1",
            android: "4.6.1"
        }
    })
}(), mqq.build("mqq.tenpay.rechargeGameCurrency", {
    android: function(a, b) {
        mqq.invokeClient("pay", "rechargeGameCurrency", JSON.stringify(a), b)
    },
    supportInvoke: !0,
    support: {
        android: "4.6.1"
    }
}), mqq.build("mqq.tenpay.rechargeQb", {
    iOS: function(a, b) {
        mqq.invokeClient("tenpay", "rechargeQb", JSON.stringify(a), b)
    },
    android: function(a, b) {
        mqq.invokeClient("pay", "rechargeQb", JSON.stringify(a), b)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.4",
        android: "4.6.1"
    }
}), mqq.build("mqq.ui.addShortcut", {
    iOS: function(a) {
        mqq.invokeClient("nav", "openLinkInSafari", {
            url: "http://open.mobile.qq.com/sdk/shortcut.ios.html?" + mqq.toQuery(a) + "#from=mqq"
        })
    },
    android: function(a) {
        a.data = {
            title: a.title,
            icon: a.icon,
            url: a.url
        }, a.callback = mqq.callback(a.callback), mqq.invokeClient("ui", "addShortcut", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.8",
        android: "5.8"
    }
}), mqq.build("mqq.ui.closeWebViews", {
    iOS: function(a) {
        mqq.invokeClient("ui", "closeWebViews", a || {})
    },
    android: function(a) {
        mqq.invokeClient("ui", "closeWebViews", a || {})
    },
    supportInvoke: !0,
    support: {
        iOS: "5.2",
        android: "5.2"
    }
}), mqq.build("mqq.ui.mobileDataDialog", {
    android: function(a) {
        var b = a.callback;
        b && (mqq.compare("7.1.5") < 0 ? b({
            result: 0
        }) : mqq.invokeClient("ui", "mobileDataDialog", {
            source: a.source,
            type: a.type,
            callback: mqq.callback(b)
        }))
    },
    iOS: function(a) {
        var b = a.callback;
        b && b({
            result: 0
        })
    },
    supportInvoke: !0,
    support: {
        android: "4.2",
        iOS: "4.2"
    }
}), mqq.build("mqq.ui.openAIO", {
    iOS: function(a) {
        mqq.invokeSchema("mqqapi", "im", "chat", a)
    },
    android: function(a) {
        mqq.invokeSchema("mqqapi", "im", "chat", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.5"
    }
}), mqq.build("mqq.ui.openGroupCard", {
    iOS: function(a) {
        mqq.invokeClient("nav", "openSpecialView", a)
    },
    android: function(a) {
        mqq.invokeClient("ui", "openSpecialView", {
            viewName: "troopMemberCard",
            param: a
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "5.8",
        android: "5.8"
    }
}), mqq.build("mqq.ui.openGroupFileView", {
    iOS: function(a) {
        mqq.invokeClient("ui", "openGroupFileView", a)
    },
    android: function(a) {
        mqq.invokeClient("ui", "openSpecialView", {
            viewName: "groupFile",
            param: a
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "5.4",
        android: "5.4"
    }
}), mqq.build("mqq.ui.openGroupPhotoView", {
    iOS: function(a) {
        mqq.invokeClient("ui", "openGroupPhotoView", a)
    },
    android: function(a) {
        mqq.invokeClient("ui", "openSpecialView", {
            viewName: "groupPhoto",
            param: a
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "5.4",
        android: "5.4"
    }
}),
function() {
    function a(a) {
        var b = c[a],
            e = +new Date;
        return b && d > e - b ? !1 : (c[a] = e, !0)
    }

    function b(a) {
        return a && 0 === a.indexOf("//") && (a = window.location.protocol + a), a
    }
    var c = {},
        d = 500;
    mqq.build("mqq.ui.openUrl", {
        iOS: function(c) {
            if (a(c.url)) {
                c || (c = {});
                var d = b(c.url);
                2 === c.target ? mqq.invokeClient("nav", "openLinkInSafari", {
                    url: d
                }) : 1 === c.target ? (c.styleCode = {
                    1: 4,
                    2: 2,
                    3: 5
                }[c.style] || 1, mqq.invokeClient("nav", "openLinkInNewWebView", {
                    url: d,
                    options: c
                })) : window.open(d, "_self")
            }
        },
        android: function(c) {
            if (a(c.url)) {
                c || (c = {});
                var d = b(c.url);
                2 === c.target ? mqq.compare("4.6") >= 0 ? mqq.invokeClient("publicAccount", "openInExternalBrowser", d) : mqq.compare("4.5") >= 0 && mqq.invokeClient("openUrlApi", "openUrl", d) : 1 === c.target ? (c.style || (c.style = 0), mqq.compare("4.7") >= 0 ? mqq.invokeClient("ui", "openUrl", {
                    url: d,
                    options: c
                }) : mqq.compare("4.6") >= 0 ? mqq.invokeClient("qbizApi", "openLinkInNewWebView", d, c.style) : mqq.compare("4.5") >= 0 ? mqq.invokeClient("publicAccount", "openUrl", d) : window.open(d, "_self")) : window.open(d, "_self")
            }
        },
        browser: function(a) {
            a || (a = {});
            var c = b(a.url);
            2 === a.target ? window.open(c, "_blank") : window.open(c, "_self")
        },
        supportInvoke: !0,
        support: {
            iOS: "4.5",
            android: "4.6",
            browser: "0"
        }
    })
}(),
function() {
    var a = {},
        b = {
            Abount: "com.tencent.mobileqq.activity.AboutActivity",
            GroupTribePublish: "com.tencent.mobileqq.troop.activity.TroopBarPublishActivity",
            GroupTribeReply: "com.tencent.mobileqq.troop.activity.TroopBarReplyActivity",
            GroupTribeComment: "com.tencent.mobileqq.troop.activity.TroopBarCommentActivity"
        };
    mqq.build("mqq.ui.openView", {
        iOS: function(b) {
            b.name = a[b.name] || b.name, "function" == typeof b.onclose && (b.onclose = mqq.callback(b.onclose)), mqq.invokeClient("nav", "openViewController", b)
        },
        android: function(a) {
            a.name = b[a.name] || a.name, "function" == typeof a.onclose && (a.onclose = mqq.callback(a.onclose)), mqq.compare("5.0") > -1 ? mqq.invokeClient("ui", "openView", a) : mqq.invokeClient("publicAccount", "open", a.name)
        },
        supportInvoke: !0,
        support: {
            iOS: "4.5",
            android: "4.6"
        }
    })
}(), mqq.build("mqq.ui.pageVisibility", {
    iOS: function(a) {
        mqq.invokeClient("ui", "pageVisibility", a)
    },
    android: function(a) {
        mqq.invokeClient("ui", "pageVisibility", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.ui.popBack", {
    iOS: function() {
        mqq.invokeClient("nav", "popBack")
    },
    android: function() {
        mqq.invokeClient("publicAccount", "close")
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.6"
    }
}), mqq.build("mqq.ui.refreshTitle", {
    iOS: function() {
        mqq.invokeClient("nav", "refreshTitle")
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6"
    }
}), mqq.build("mqq.ui.returnToAIO", {
    iOS: function() {
        mqq.invokeClient("nav", "returnToAIO")
    },
    android: function() {
        mqq.invokeClient("qbizApi", "returnToAIO")
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.ui.scanQRcode", {
    iOS: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("ui", "scanQRcode", a)
    },
    android: function(a, b) {
        a = a || {}, b && (a.callback = mqq.callback(b)), mqq.invokeClient("ui", "scanQRcode", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.ui.selectContact", {
    iOS: function(a) {
        var b = mqq.callback(a.callback);
        a.callback = b, mqq.invokeClient("ui", "selectContact", a)
    },
    android: function(a) {
        var b = mqq.callback(a.callback);
        a.callback = b, mqq.invokeClient("ui", "selectContact", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.3",
        android: "5.3"
    }
}), mqq.build("mqq.ui.setActionButton", {
    iOS: function(a, b) {
        "object" != typeof a && (a = {
            title: a
        });
        var c = mqq.callback(b);
        a.callback = c, mqq.invokeClient("nav", "setActionButton", a)
    },
    android: function(a, b) {
        var c = mqq.callback(b);
        a.hidden && (a.title = ""), mqq.compare("4.7") >= 0 ? (a.callback = c, mqq.invokeClient("ui", "setActionButton", a)) : mqq.invokeClient("publicAccount", "setRightButton", a.title, "", c || null)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.ui.setLoading", {
    iOS: function(a) {
        a && (a.visible === !0 ? mqq.invokeClient("nav", "showLoading") : a.visible === !1 && mqq.invokeClient("nav", "hideLoading"), a.color && mqq.invokeClient("nav", "setLoadingColor", {
            r: a.color[0],
            g: a.color[1],
            b: a.color[2]
        }))
    },
    android: function(a) {
        "visible" in a && (a.visible ? mqq.invokeClient("publicAccount", "showLoading") : mqq.invokeClient("publicAccount", "hideLoading"))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.ui.setOnCloseHandler", {
    iOS: function(a) {
        mqq.invokeClient("ui", "setOnCloseHandler", {
            callback: mqq.callback(a)
        })
    },
    android: function(a) {
        mqq.invokeClient("ui", "setOnCloseHandler", {
            callback: mqq.callback(a)
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.ui.setOnShareHandler", {
    iOS: function(a) {
        mqq.invokeClient("nav", "addWebShareListener", {
            callback: mqq.callback(a)
        })
    },
    android: function(a) {
        mqq.invokeClient("ui", "setOnShareHandler", {
            callback: mqq.callback(a)
        })
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.2",
        android: "4.7.2"
    }
}), mqq.build("mqq.ui.setPullDown", {
    iOS: function(a) {
        mqq.invokeClient("ui", "setPullDown", a)
    },
    android: function(a) {
        mqq.invokeClient("ui", "setPullDown", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.3",
        android: "5.3"
    }
}), mqq.build("mqq.ui.setRightDragToGoBackParams", {
    iOS: function(a) {
        mqq.invokeClient("ui", "setRightDragToGoBackParams", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.3"
    }
}), mqq.build("mqq.ui.setTitleButtons", {
    iOS: function(a) {
        var b = a.left,
            c = a.right;
        b && (b.callback = mqq.callback(b.callback)), c && (c.callback = mqq.callback(c.callback)), mqq.compare("5.3") >= 0 ? mqq.invokeClient("ui", "setTitleButtons", a) : (b && (b.title && mqq.invokeClient("ui", "setLeftBtnTitle", {
            title: b.title
        }), b.callback && mqq.invokeClient("ui", "setOnCloseHandler", b)), c && mqq.invokeClient("nav", "setActionButton", c))
    },
    android: function(a) {
        var b = a.left,
            c = a.right;
        b && (b.callback = mqq.callback(b.callback)), c && (c.callback = mqq.callback(c.callback)), mqq.compare("5.3") >= 0 ? mqq.invokeClient("ui", "setTitleButtons", a) : (b && b.callback && mqq.invokeClient("ui", "setOnCloseHandler", b), c && (c.hidden && (c.title = ""), mqq.compare("4.7") >= 0 ? mqq.invokeClient("ui", "setActionButton", c) : mqq.invokeClient("publicAccount", "setRightButton", c.title, "", c.callback)))
    },
    supportInvoke: !0,
    support: {
        iOS: "5.0",
        android: "4.6"
    }
}), mqq.build("mqq.ui.setWebViewBehavior", {
    iOS: function(a) {
        mqq.invokeClient("ui", "setWebViewBehavior", a)
    },
    android: function(a) {
        mqq.invokeClient("ui", "setWebViewBehavior", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.2",
        android: "5.1"
    }
}), mqq.build("mqq.ui.shareArkMessage", {
    iOS: function(a, b) {
        mqq.invokeClient("QQApi", "shareArkMessage", a, mqq.callback(b))
    },
    android: function(a, b) {
        mqq.invokeClient("QQApi", "shareArkMessage", a, mqq.callback(b))
    },
    supportInvoke: !0,
    support: {
        iOS: "7.2.5",
        android: "7.2.5"
    }
}), mqq.build("mqq.ui.shareAudio", {
    iOS: function(a, b) {
        var c = mqq.callback(b, !0);
        a.desc && (a.desc = a.desc.length > 50 ? a.desc.substring(0, 50) + "..." : a.desc), mqq.invokeClient("nav", "shareAudio", {
            params: a,
            callback: c
        })
    },
    android: function(a, b) {
        a.req_type = 2, b && (a.callback = mqq.callback(b, !0)), a.desc && (a.desc = a.desc.length > 50 ? a.desc.substring(0, 50) + "..." : a.desc), mqq.invokeClient("QQApi", "shareMsg", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.ui.shareMessage", {
    iOS: function(a, b) {
        !("needPopBack" in a) && "back" in a && (a.needPopBack = a.back), a.share_url && (a.share_url = mqq.removeQuery(a.share_url, ["sid", "3g_sid"])), a.desc && (a.desc = a.desc.length > 50 ? a.desc.substring(0, 50) + "..." : a.desc), a.toUin && (a.toUin += ""), a.sourceName && (a.srcName = a.sourceName), a.callback = mqq.callback(b, !0, !0), mqq.invokeClient("nav", "shareURLWebRichData", a)
    },
    android: function(a, b) {
        if (a.share_url && (a.share_url = mqq.removeQuery(a.share_url, ["sid", "3g_sid"])), a.callback = mqq.callback(function(a) {
            b && b({
                retCode: a ? 0 : 1
            })
        }, !0), a.desc && (a.desc = a.desc.length > 50 ? a.desc.substring(0, 50) + "..." : a.desc), a.srcName && (a.sourceName = a.srcName), a.share_type && (2 === a.share_type || 3 === a.share_type) && mqq.compare("5.2") < 0 && mqq.support("mqq.app.isAppInstalled")) {
            var c = "您尚未安装微信，不可使用此功能";
            mqq.app.isAppInstalled("com.tencent.mm", function(b) {
                b ? mqq.invokeClient("QQApi", "shareMsg", a) : mqq.support("mqq.ui.showTips") ? mqq.ui.showTips({
                    text: c
                }) : alert(c)
            })
        } else mqq.invokeClient("QQApi", "shareMsg", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7.2",
        android: "4.7.2"
    }
}), mqq.build("mqq.ui.shareRichMessage", {
    iOS: function(a, b) {
        a.puin = a.oaUin, a.desc = a.desc || a.summary, a.share_url && (a.share_url = mqq.removeQuery(a.share_url, ["sid", "3g_sid"])), a.desc && (a.desc = a.desc.length > 50 ? a.desc.substring(0, 50) + "..." : a.desc), a.callback = mqq.callback(b), mqq.invokeClient("nav", "officalAccountShareRichMsg2QQ", a)
    },
    android: function(a, b) {
        a.puin = a.oaUin, a.desc = a.desc || a.summary, a.desc && (a.desc = a.desc.length > 50 ? a.desc.substring(0, 50) + "..." : a.desc),
            mqq.compare("5.0") >= 0 ? (a.share_url = a.share_url || a.targetUrl, a.image_url = a.image_url || a.imageUrl, a.share_url && (a.share_url = mqq.removeQuery(a.share_url, ["sid", "3g_sid"])), a.callback = b ? mqq.callback(function(a) {
                b({
                    ret: a ? 0 : 1
                })
            }) : null, mqq.invokeClient("QQApi", "shareMsg", a)) : (a.targetUrl = a.targetUrl || a.share_url, a.imageUrl = a.imageUrl || a.image_url, a.targetUrl && (a.targetUrl = mqq.removeQuery(a.targetUrl, ["sid", "3g_sid"])), a.callback = mqq.callback(b), mqq.invokeClient("publicAccount", "officalAccountShareRichMsg2QQ", a))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.data.shareRichMessage", {
    iOS: mqq.ui.shareRichMessage,
    android: mqq.ui.shareRichMessage,
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.ui.showActionSheet", {
    iOS: function(a, b) {
        return b && (a.onclick = mqq.callback(b)), mqq.invokeClient("ui", "showActionSheet", a)
    },
    android: function(a, b) {
        return b && (a.onclick = mqq.callback(b)), mqq.invokeClient("ui", "showActionSheet", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.ui.showBarAccountDetail", {
    iOS: function(a) {
        var b = "object" == typeof a ? a : {
            uin: a
        };
        b.type = 3, mqq.invokeClient("nav", "showOfficalAccountDetail", b)
    },
    android: function(a) {
        mqq.invokeClient("publicAccount", "viewTroopBarAccount", a.uin)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.6",
        android: "5.4"
    }
}), mqq.build("mqq.ui.showDialog", {
    iOS: function(a, b) {
        a && (a.callback = mqq.callback(b, !0), a.title = a.title + "", a.text = a.text + "", "needOkBtn" in a || (a.needOkBtn = !0), "needCancelBtn" in a || (a.needCancelBtn = !0), a.okBtnStr = a.okBtnText, a.cancelBtnStr = a.cancelBtnText, mqq.invokeClient("nav", "showDialog", a))
    },
    android: function(a, b) {
        if (mqq.compare("4.8.0") >= 0) a.callback = mqq.callback(b, !0), mqq.invokeClient("ui", "showDialog", a);
        else {
            var c = "",
                d = "";
            b && (c = mqq.callback(function() {
                b({
                    button: 0
                })
            }, !0), d = mqq.callback(function() {
                b({
                    button: 1
                })
            }, !0), c += "()", d += "()"), a.title = a.title + "", a.text = a.text + "", "needOkBtn" in a || (a.needOkBtn = !0), "needCancelBtn" in a || (a.needCancelBtn = !0), mqq.invokeClient("publicAccount", "showDialog", a.title, a.text, a.needOkBtn, a.needCancelBtn, c, d)
        }
    },
    supportInvoke: !0,
    support: {
        iOS: "4.6",
        android: "4.6"
    }
}), mqq.build("mqq.ui.showEQQ", {
    iOS: function(a) {
        mqq.invokeClient("nav", "showBusinessAccountProfile", a)
    },
    android: function(a) {
        mqq.invokeClient("eqq", "showEQQ", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.ui.showOfficalAccountDetail", {
    iOS: function(a) {
        var b = "object" == typeof a ? a : {
            uin: a
        };
        mqq.invokeClient("nav", "showOfficalAccountDetail", b)
    },
    android: function(a) {
        mqq.compare("4.6") >= 0 ? mqq.invokeClient("publicAccount", "viewAccount", a.uin, a.showAIO) : mqq.invokeClient("publicAccount", "viewAccount", a.uin)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.6"
    }
}), mqq.build("mqq.ui.showOfficialAccountProfile", {
    iOS: function(a) {
        mqq.compare("6.0") >= 0 ? mqq.invokeClient("publicAccount", "showOfficialAccountProfile", a) : (a.showAIO = !1, mqq.invokeClient("nav", "showOfficalAccountDetail", a))
    },
    android: function(a) {
        mqq.compare("6.0") >= 0 ? mqq.invokeClient("publicAccountNew", "showOfficialAccountProfile", a) : mqq.compare("4.6") >= 0 ? mqq.invokeClient("publicAccount", "viewAccount", a.uin, !1) : mqq.invokeClient("publicAccount", "viewAccount", a.uin)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.6"
    }
}), mqq.build("mqq.ui.showProfile", {
    iOS: function(a) {
        mqq.compare("4.7") >= 0 ? (a.uin += "", mqq.invokeClient("nav", "showProfile", a)) : mqq.compare("4.6") >= 0 && !a.uinType ? mqq.invokeClient("nav", "showProfile", a) : (1 === a.uinType && (a.card_type = "group"), mqq.invokeSchema("mqqapi", "card", "show_pslcard", a))
    },
    android: function(a) {
        mqq.compare("4.7") >= 0 ? mqq.invokeClient("publicAccount", "showProfile", a) : mqq.compare("4.6") >= 0 && !a.uinType ? mqq.invokeClient("publicAccount", "showProfile", a.uin) : (1 === a.uinType && (a.card_type = "group"), mqq.invokeSchema("mqqapi", "card", "show_pslcard", a))
    },
    supportInvoke: !0,
    support: {
        iOS: "4.5",
        android: "4.5"
    }
}), mqq.build("mqq.ui.showShareMenu", {
    iOS: function() {
        mqq.invokeClient("ui", "showShareMenu")
    },
    android: function() {
        mqq.invokeClient("ui", "showShareMenu")
    },
    supportInvoke: !0,
    support: {
        iOS: "5.2",
        android: "5.2"
    }
}), mqq.build("mqq.ui.showTips", {
    iOS: function(a) {
        a.iconMode = a.iconMode || 2, mqq.invokeClient("ui", "showTips", a)
    },
    android: function(a) {
        a.iconMode = a.iconMode || 2, mqq.invokeClient("ui", "showTips", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "4.7",
        android: "4.7"
    }
}), mqq.build("mqq.viewTracks.getTrackInfo", {
    iOS: function(a, b) {
        a = a || {};
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("viewTracks", "getTrackInfo", a)
    },
    android: function(a, b) {
        a = a || {};
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("viewTracks", "getTrackInfo", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.1",
        android: "5.1"
    }
}), mqq.build("mqq.viewTracks.pop", {
    iOS: function(a, b) {
        a = a || {};
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("viewTracks", "pop", a)
    },
    android: function(a, b) {
        a = a || {};
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("viewTracks", "pop", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.1",
        android: "5.1"
    }
}), mqq.build("mqq.viewTracks.push", {
    iOS: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("viewTracks", "push", a)
    },
    android: function(a, b) {
        var c = mqq.callback(b);
        c && (a.callback = c), mqq.invokeClient("viewTracks", "push", a)
    },
    supportInvoke: !0,
    support: {
        iOS: "5.1",
        android: "5.1"
    }
});