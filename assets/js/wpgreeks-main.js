! function e(t, n, r) {
    function a(i, l) {
        if (!n[i]) {
            if (!t[i]) {
                var o = "function" == typeof require && require;
                if (!l && o) return o(i, !0);
                if (s) return s(i, !0);
                var u = new Error("Cannot find module '" + i + "'");
                throw u.code = "MODULE_NOT_FOUND", u
            }
            var c = n[i] = {
                exports: {}
            };
            t[i][0].call(c.exports, function(e) {
                var n = t[i][1][e];
                return a(n || e)
            }, c, c.exports, e, t, n, r)
        }
        return n[i].exports
    }
    for (var s = "function" == typeof require && require, i = 0; i < r.length; i++) a(r[i]);
    return a
}({
    1: [function(e, t, n) {
        window.PR_SHOULD_USE_CONTINUATION = !0;
        ! function() {
            function e(e, t, n, r, a) {
                if (n) {
                    var s = {
                        sourceNode: e,
                        pre: 1,
                        langExtension: null,
                        numberLines: null,
                        sourceCode: n,
                        spans: null,
                        basePos: t,
                        decorations: null
                    };
                    r(s), a.push.apply(a, s.decorations)
                }
            }

            function t(e) {
                for (var t = void 0, n = e.firstChild; n; n = n.nextSibling) {
                    var r = n.nodeType;
                    t = 1 === r ? t ? e : n : 3 === r && R.test(n.nodeValue) ? e : t
                }
                return t === e ? void 0 : t
            }

            function n(t, n) {
                var r, a = {};
                ! function() {
                    for (var e = t.concat(n), s = [], i = {}, l = 0, o = e.length; l < o; ++l) {
                        var u = e[l],
                            c = u[3];
                        if (c)
                            for (var d = c.length; --d >= 0;) a[c.charAt(d)] = u;
                        var f = u[1],
                            p = "" + f;
                        i.hasOwnProperty(p) || (s.push(f), i[p] = null)
                    }
                    s.push(/[\0-\uffff]/), r = function(e) {
                        function t(e) {
                            var t = e.charCodeAt(0);
                            if (92 !== t) return t;
                            var n = e.charAt(1);
                            return (t = c[n]) || ("0" <= n && n <= "7" ? parseInt(e.substring(1), 8) : "u" === n || "x" === n ? parseInt(e.substring(2), 16) : e.charCodeAt(1))
                        }

                        function n(e) {
                            if (e < 32) return (e < 16 ? "\\x0" : "\\x") + e.toString(16);
                            var t = String.fromCharCode(e);
                            return "\\" === t || "-" === t || "]" === t || "^" === t ? "\\" + t : t
                        }

                        function r(e) {
                            var r = e.substring(1, e.length - 1).match(new RegExp("\\\\u[0-9A-Fa-f]{4}|\\\\x[0-9A-Fa-f]{2}|\\\\[0-3][0-7]{0,2}|\\\\[0-7]{1,2}|\\\\[\\s\\S]|-|[^-\\\\]", "g")),
                                a = [],
                                s = "^" === r[0],
                                i = ["["];
                            s && i.push("^");
                            for (var l = s ? 1 : 0, o = r.length; l < o; ++l) {
                                var u = r[l];
                                if (/\\[bdsw]/i.test(u)) i.push(u);
                                else {
                                    var c, d = t(u);
                                    l + 2 < o && "-" === r[l + 1] ? (c = t(r[l + 2]), l += 2) : c = d, a.push([d, c]), c < 65 || d > 122 || (c < 65 || d > 90 || a.push([32 | Math.max(65, d), 32 | Math.min(c, 90)]), c < 97 || d > 122 || a.push([-33 & Math.max(97, d), -33 & Math.min(c, 122)]))
                                }
                            }
                            a.sort(function(e, t) {
                                return e[0] - t[0] || t[1] - e[1]
                            });
                            var f = [],
                                p = [];
                            for (l = 0; l < a.length; ++l)(g = a[l])[0] <= p[1] + 1 ? p[1] = Math.max(p[1], g[1]) : f.push(p = g);
                            for (l = 0; l < f.length; ++l) {
                                var g = f[l];
                                i.push(n(g[0])), g[1] > g[0] && (g[1] + 1 > g[0] && i.push("-"), i.push(n(g[1])))
                            }
                            return i.push("]"), i.join("")
                        }

                        function a(e) {
                            for (var t = e.source.match(new RegExp("(?:\\[(?:[^\\x5C\\x5D]|\\\\[\\s\\S])*\\]|\\\\u[A-Fa-f0-9]{4}|\\\\x[A-Fa-f0-9]{2}|\\\\[0-9]+|\\\\[^ux0-9]|\\(\\?[:!=]|[\\(\\)\\^]|[^\\x5B\\x5C\\(\\)\\^]+)", "g")), a = t.length, l = [], o = 0, u = 0; o < a; ++o) "(" === (d = t[o]) ? ++u : "\\" === d.charAt(0) && (c = +d.substring(1)) && (c <= u ? l[c] = -1 : t[o] = n(c));
                            for (o = 1; o < l.length; ++o) - 1 === l[o] && (l[o] = ++s);
                            for (o = 0, u = 0; o < a; ++o)
                                if ("(" === (d = t[o])) l[++u] || (t[o] = "(?:");
                                else if ("\\" === d.charAt(0)) {
                                var c;
                                (c = +d.substring(1)) && c <= u && (t[o] = "\\" + l[c])
                            }
                            for (o = 0; o < a; ++o) "^" === t[o] && "^" !== t[o + 1] && (t[o] = "");
                            if (e.ignoreCase && i)
                                for (o = 0; o < a; ++o) {
                                    var d, f = (d = t[o]).charAt(0);
                                    d.length >= 2 && "[" === f ? t[o] = r(d) : "\\" !== f && (t[o] = d.replace(/[a-zA-Z]/g, function(e) {
                                        var t = e.charCodeAt(0);
                                        return "[" + String.fromCharCode(-33 & t, 32 | t) + "]"
                                    }))
                                }
                            return t.join("")
                        }
                        for (var s = 0, i = !1, l = !1, o = 0, u = e.length; o < u; ++o)
                            if ((f = e[o]).ignoreCase) l = !0;
                            else if (/[a-z]/i.test(f.source.replace(/\\u[0-9a-f]{4}|\\x[0-9a-f]{2}|\\[^ux]/gi, ""))) {
                            i = !0, l = !1;
                            break
                        }
                        var c = {
                                b: 8,
                                t: 9,
                                n: 10,
                                v: 11,
                                f: 12,
                                r: 13
                            },
                            d = [];
                        for (o = 0, u = e.length; o < u; ++o) {
                            var f;
                            if ((f = e[o]).global || f.multiline) throw new Error("" + f);
                            d.push("(?:" + a(f) + ")")
                        }
                        return new RegExp(d.join("|"), l ? "gi" : "g")
                    }(s)
                }();
                var s = n.length,
                    l = function(t) {
                        for (var o = t.sourceCode, u = t.basePos, c = t.sourceNode, d = [u, k], f = 0, p = o.match(r) || [], g = {}, h = 0, m = p.length; h < m; ++h) {
                            var v, y = p[h],
                                b = g[y],
                                x = void 0;
                            if ("string" == typeof b) v = !1;
                            else {
                                var w = a[y.charAt(0)];
                                if (w) x = y.match(w[1]), b = w[0];
                                else {
                                    for (var S = 0; S < s; ++S)
                                        if (w = n[S], x = y.match(w[1])) {
                                            b = w[0];
                                            break
                                        } x || (b = k)
                                }!(v = b.length >= 5 && "lang-" === b.substring(0, 5)) || x && "string" == typeof x[1] || (v = !1, b = A), v || (g[y] = b)
                            }
                            var C = f;
                            if (f += y.length, v) {
                                var N = x[1],
                                    _ = y.indexOf(N),
                                    E = _ + N.length;
                                x[2] && (_ = (E = y.length - x[2].length) - N.length);
                                var L = b.substring(5);
                                e(c, u + C, y.substring(0, _), l, d), e(c, u + C + _, N, i(L, N), d), e(c, u + C + E, y.substring(E), l, d)
                            } else d.push(u + C, b)
                        }
                        t.decorations = d
                    };
                return l
            }

            function r(e) {
                var t = [],
                    r = [];
                e.tripleQuotedStrings ? t.push([S, /^(?:\'\'\'(?:[^\'\\]|\\[\s\S]|\'{1,2}(?=[^\']))*(?:\'\'\'|$)|\"\"\"(?:[^\"\\]|\\[\s\S]|\"{1,2}(?=[^\"]))*(?:\"\"\"|$)|\'(?:[^\\\']|\\[\s\S])*(?:\'|$)|\"(?:[^\\\"]|\\[\s\S])*(?:\"|$))/, null, "'\""]) : e.multiLineStrings ? t.push([S, /^(?:\'(?:[^\\\']|\\[\s\S])*(?:\'|$)|\"(?:[^\\\"]|\\[\s\S])*(?:\"|$)|\`(?:[^\\\`]|\\[\s\S])*(?:\`|$))/, null, "'\"`"]) : t.push([S, /^(?:\'(?:[^\\\'\r\n]|\\.)*(?:\'|$)|\"(?:[^\\\"\r\n]|\\.)*(?:\"|$))/, null, "\"'"]), e.verbatimStrings && r.push([S, /^@\"(?:[^\"]|\"\")*(?:\"|$)/, null]);
                var a = e.hashComments;
                a && (e.cStyleComments ? (a > 1 ? t.push([N, /^#(?:##(?:[^#]|#(?!##))*(?:###|$)|.*)/, null, "#"]) : t.push([N, /^#(?:(?:define|e(?:l|nd)if|else|error|ifn?def|include|line|pragma|undef|warning)\b|[^\r\n]*)/, null, "#"]), r.push([S, /^<(?:(?:(?:\.\.\/)*|\/?)(?:[\w-]+(?:\/[\w-]+)+)?[\w-]+\.h(?:h|pp|\+\+)?|[a-z]\w*)>/, null])) : t.push([N, /^#[^\r\n]*/, null, "#"])), e.cStyleComments && (r.push([N, /^\/\/[^\r\n]*/, null]), r.push([N, /^\/\*[\s\S]*?(?:\*\/|$)/, null]));
                var s = e.regexLiterals;
                if (s) {
                    var i = s > 1 ? "" : "\n\r",
                        l = i ? "." : "[\\S\\s]",
                        o = "/(?=[^/*" + i + "])(?:[^/\\x5B\\x5C" + i + "]|\\x5C" + l + "|\\x5B(?:[^\\x5C\\x5D" + i + "]|\\x5C" + l + ")*(?:\\x5D|$))+/";
                    r.push(["lang-regex", RegExp("^" + P + "(" + o + ")")])
                }
                var u = e.types;
                u && r.push([_, u]);
                var c = ("" + e.keywords).replace(/^ | $/g, "");
                c.length && r.push([C, new RegExp("^(?:" + c.replace(/[\s,]+/g, "|") + ")\\b"), null]), t.push([k, /^\s+/, null, " \r\n\t "]);
                var d = "^.[^\\s\\w.$@'\"`/\\\\]*";
                return e.regexLiterals && (d += "(?!s*/)"), r.push([E, /^@[a-z_$][a-z_$@0-9]*/i, null], [_, /^(?:[@_]?[A-Z]+[a-z][A-Za-z_$@0-9]*|\w+_t\b)/, null], [k, /^[a-z_$][a-z_$@0-9]*/i, null], [E, new RegExp("^(?:0x[a-f0-9]+|(?:\\d(?:_\\d+)*\\d*(?:\\.\\d*)?|\\.\\d\\+)(?:e[+\\-]?\\d+)?)[a-z]*", "i"), null, "0123456789"], [k, /^\\[\s\S]?/, null], [L, new RegExp(d), null]), n(t, r)
            }

            function a(e, t, n) {
                function r(e) {
                    var t = e.nodeType;
                    if (1 != t || s.test(e.className)) {
                        if ((3 == t || 4 == t) && n) {
                            var o = e.nodeValue,
                                u = o.match(i);
                            if (u) {
                                var c = o.substring(0, u.index);
                                e.nodeValue = c;
                                var d = o.substring(u.index + u[0].length);
                                if (d) {
                                    e.parentNode.insertBefore(l.createTextNode(d), e.nextSibling)
                                }
                                a(e), c || e.parentNode.removeChild(e)
                            }
                        }
                    } else if ("br" === e.nodeName) a(e), e.parentNode && e.parentNode.removeChild(e);
                    else
                        for (var f = e.firstChild; f; f = f.nextSibling) r(f)
                }

                function a(e) {
                    function t(e, n) {
                        var r = n ? e.cloneNode(!1) : e,
                            a = e.parentNode;
                        if (a) {
                            var s = t(a, 1),
                                i = e.nextSibling;
                            s.appendChild(r);
                            for (var l = i; l; l = i) i = l.nextSibling, s.appendChild(l)
                        }
                        return r
                    }
                    for (; !e.nextSibling;)
                        if (!(e = e.parentNode)) return;
                    for (var n, r = t(e.nextSibling, 0);
                        (n = r.parentNode) && 1 === n.nodeType;) r = n;
                    u.push(r)
                }
                for (var s = /(?:^|\s)nocode(?:\s|$)/, i = /\r\n?|\n/, l = e.ownerDocument, o = l.createElement("li"); e.firstChild;) o.appendChild(e.firstChild);
                for (var u = [o], c = 0; c < u.length; ++c) r(u[c]);
                t === (0 | t) && u[0].setAttribute("value", t);
                var d = l.createElement("ol");
                d.className = "linenums";
                for (var f = Math.max(0, t - 1 | 0) || 0, p = (c = 0, u.length); c < p; ++c)(o = u[c]).className = "L" + (c + f) % 10, o.firstChild || o.appendChild(l.createTextNode(" ")), d.appendChild(o);
                e.appendChild(d)
            }

            function s(e, t) {
                for (var n = t.length; --n >= 0;) {
                    var r = t[n];
                    T.hasOwnProperty(r) ? c.console && console.warn("cannot override language handler %s", r) : T[r] = e
                }
            }

            function i(e, t) {
                return e && T.hasOwnProperty(e) || (e = /^\s*</.test(t) ? "default-markup" : "default-code"), T[e]
            }

            function l(e) {
                var t = e.langExtension;
                try {
                    var n = function(e, t) {
                            function n(e) {
                                var o = e.nodeType;
                                if (1 == o) {
                                    if (r.test(e.className)) return;
                                    for (var u = e.firstChild; u; u = u.nextSibling) n(u);
                                    var c = e.nodeName.toLowerCase();
                                    "br" !== c && "li" !== c || (a[l] = "\n", i[l << 1] = s++, i[l++ << 1 | 1] = e)
                                } else if (3 == o || 4 == o) {
                                    var d = e.nodeValue;
                                    d.length && (d = t ? d.replace(/\r\n?/g, "\n") : d.replace(/[ \t\r\n]+/g, " "), a[l] = d, i[l << 1] = s, s += d.length, i[l++ << 1 | 1] = e)
                                }
                            }
                            var r = /(?:^|\s)nocode(?:\s|$)/,
                                a = [],
                                s = 0,
                                i = [],
                                l = 0;
                            return n(e), {
                                sourceCode: a.join("").replace(/\n$/, ""),
                                spans: i
                            }
                        }(e.sourceNode, e.pre),
                        r = n.sourceCode;
                    e.sourceCode = r, e.spans = n.spans, e.basePos = 0, i(t, r)(e),
                        function(e) {
                            var t = /\bMSIE\s(\d+)/.exec(navigator.userAgent);
                            t = t && +t[1] <= 8;
                            var n = /\n/g,
                                r = e.sourceCode,
                                a = r.length,
                                s = 0,
                                i = e.spans,
                                l = i.length,
                                o = 0,
                                u = e.decorations,
                                c = u.length,
                                d = 0;
                            u[c] = a;
                            var f, p;
                            for (p = f = 0; p < c;) u[p] !== u[p + 2] ? (u[f++] = u[p++], u[f++] = u[p++]) : p += 2;
                            for (c = f, p = f = 0; p < c;) {
                                for (var g = u[p], h = u[p + 1], m = p + 2; m + 2 <= c && u[m + 1] === h;) m += 2;
                                u[f++] = g, u[f++] = h, p = m
                            }
                            c = u.length = f;
                            var v = e.sourceNode,
                                y = "";
                            v && (y = v.style.display, v.style.display = "none");
                            try {
                                for (; o < l;) {
                                    i[o];
                                    var b, x = i[o + 2] || a,
                                        w = u[d + 2] || a,
                                        S = (m = Math.min(x, w), i[o + 1]);
                                    if (1 !== S.nodeType && (b = r.substring(s, m))) {
                                        t && (b = b.replace(n, "\r")), S.nodeValue = b;
                                        var C = S.ownerDocument,
                                            N = C.createElement("span");
                                        N.className = u[d + 1];
                                        var _ = S.parentNode;
                                        _.replaceChild(N, S), N.appendChild(S), s < x && (i[o + 1] = S = C.createTextNode(r.substring(m, x)), _.insertBefore(S, N.nextSibling))
                                    }(s = m) >= x && (o += 2), s >= w && (d += 2)
                                }
                            } finally {
                                v && (v.style.display = y)
                            }
                        }(e)
                } catch (e) {
                    c.console && console.log(e && e.stack || e)
                }
            }

            function o(e, t, n) {
                var r = n || !1,
                    s = t || null,
                    i = document.createElement("div");
                i.innerHTML = "<pre>" + e + "</pre>", i = i.firstChild, r && a(i, r, !0);
                return l({
                    langExtension: s,
                    numberLines: r,
                    sourceNode: i,
                    pre: 1,
                    sourceCode: null,
                    basePos: null,
                    spans: null,
                    decorations: null
                }), i.innerHTML
            }

            function u(e, n) {
                function r(e) {
                    return i.getElementsByTagName(e)
                }

                function s() {
                    for (var n = c.PR_SHOULD_USE_CONTINUATION ? h.now() + 250 : 1 / 0; m < d.length && h.now() < n; m++) {
                        for (var r = d[m], i = C, u = r; u = u.previousSibling;) {
                            var f = u.nodeType,
                                p = (7 === f || 8 === f) && u.nodeValue;
                            if (p ? !/^\??prettify\b/.test(p) : 3 !== f || /\S/.test(u.nodeValue)) break;
                            if (p) {
                                i = {}, p.replace(/\b(\w+)=([\w:.%+-]+)/g, function(e, t, n) {
                                    i[t] = n
                                });
                                break
                            }
                        }
                        var g = r.className;
                        if ((i !== C || y.test(g)) && !b.test(g)) {
                            for (var N = !1, _ = r.parentNode; _; _ = _.parentNode) {
                                var E = _.tagName;
                                if (S.test(E) && _.className && y.test(_.className)) {
                                    N = !0;
                                    break
                                }
                            }
                            if (!N) {
                                r.className += " prettyprinted";
                                var L = i.lang;
                                if (!L) {
                                    var k;
                                    !(L = g.match(v)) && (k = t(r)) && w.test(k.tagName) && (L = k.className.match(v)), L && (L = L[1])
                                }
                                var A;
                                if (x.test(r.tagName)) A = 1;
                                else {
                                    var P = r.currentStyle,
                                        R = o.defaultView,
                                        T = P ? P.whiteSpace : R && R.getComputedStyle ? R.getComputedStyle(r, null).getPropertyValue("white-space") : 0;
                                    A = T && "pre" === T.substring(0, 3)
                                }
                                var $ = i.linenums;
                                ($ = "true" === $ || +$) || ($ = !!($ = g.match(/\blinenums\b(?::(\d+))?/)) && (!$[1] || !$[1].length || +$[1])), $ && a(r, $, A);
                                l({
                                    langExtension: L,
                                    sourceNode: r,
                                    numberLines: $,
                                    pre: A,
                                    sourceCode: null,
                                    basePos: null,
                                    spans: null,
                                    decorations: null
                                })
                            }
                        }
                    }
                    m < d.length ? c.setTimeout(s, 250) : "function" == typeof e && e()
                }
                for (var i = n || document.body, o = i.ownerDocument || document, u = [r("pre"), r("code"), r("xmp")], d = [], f = 0; f < u.length; ++f)
                    for (var p = 0, g = u[f].length; p < g; ++p) d.push(u[f][p]);
                u = null;
                var h = Date;
                h.now || (h = {
                    now: function() {
                        return +new Date
                    }
                });
                var m = 0,
                    v = /\blang(?:uage)?-([\w.]+)(?!\S)/,
                    y = /\bprettyprint\b/,
                    b = /\bprettyprinted\b/,
                    x = /pre|xmp/i,
                    w = /^code$/i,
                    S = /^(?:pre|code|xmp)$/i,
                    C = {};
                s()
            }
            var c = window,
                d = ["break,continue,do,else,for,if,return,while"],
                f = [
                    [d, "auto,case,char,const,default,double,enum,extern,float,goto,inline,int,long,register,restrict,short,signed,sizeof,static,struct,switch,typedef,union,unsigned,void,volatile"], "catch,class,delete,false,import,new,operator,private,protected,public,this,throw,true,try,typeof"
                ],
                p = [f, "alignas,alignof,align_union,asm,axiom,bool,concept,concept_map,const_cast,constexpr,decltype,delegate,dynamic_cast,explicit,export,friend,generic,late_check,mutable,namespace,noexcept,noreturn,nullptr,property,reinterpret_cast,static_assert,static_cast,template,typeid,typename,using,virtual,where"],
                g = [f, "abstract,assert,boolean,byte,extends,finally,final,implements,import,instanceof,interface,null,native,package,strictfp,super,synchronized,throws,transient"],
                h = [f, "abstract,add,alias,as,ascending,async,await,base,bool,by,byte,checked,decimal,delegate,descending,dynamic,event,finally,fixed,foreach,from,get,global,group,implicit,in,interface,internal,into,is,join,let,lock,null,object,out,override,orderby,params,partial,readonly,ref,remove,sbyte,sealed,select,set,stackalloc,string,select,uint,ulong,unchecked,unsafe,ushort,value,var,virtual,where,yield"],
                m = [f, "abstract,async,await,constructor,debugger,enum,eval,export,function,get,implements,instanceof,interface,let,null,set,undefined,var,with,yield,Infinity,NaN"],
                v = "caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END",
                y = [d, "and,as,assert,class,def,del,elif,except,exec,finally,from,global,import,in,is,lambda,nonlocal,not,or,pass,print,raise,try,with,yield,False,True,None"],
                b = [d, "alias,and,begin,case,class,def,defined,elsif,end,ensure,false,in,module,next,nil,not,or,redo,rescue,retry,self,super,then,true,undef,unless,until,when,yield,BEGIN,END"],
                x = [d, "case,done,elif,esac,eval,fi,function,in,local,set,then,until"],
                w = /^(DIR|FILE|array|vector|(de|priority_)?queue|(forward_)?list|stack|(const_)?(reverse_)?iterator|(unordered_)?(multi)?(set|map)|bitset|u?(int|float)\d*)\b/,
                S = "str",
                C = "kwd",
                N = "com",
                _ = "typ",
                E = "lit",
                L = "pun",
                k = "pln",
                A = "src",
                P = "(?:^^\\.?|[+-]|[!=]=?=?|\\#|%=?|&&?=?|\\(|\\*=?|[+\\-]=|->|\\/=?|::?|<<?=?|>>?>?=?|,|;|\\?|@|\\[|~|{|\\^\\^?=?|\\|\\|?=?|break|case|continue|delete|do|else|finally|instanceof|return|throw|try|typeof)\\s*",
                R = /\S/,
                T = {};
            s(r({
                keywords: [p, h, g, m, v, y, b, x],
                hashComments: !0,
                cStyleComments: !0,
                multiLineStrings: !0,
                regexLiterals: !0
            }), ["default-code"]), s(n([], [
                [k, /^[^<?]+/],
                ["dec", /^<!\w[^>]*(?:>|$)/],
                [N, /^<\!--[\s\S]*?(?:-\->|$)/],
                ["lang-", /^<\?([\s\S]+?)(?:\?>|$)/],
                ["lang-", /^<%([\s\S]+?)(?:%>|$)/],
                [L, /^(?:<[%?]|[%?]>)/],
                ["lang-", /^<xmp\b[^>]*>([\s\S]+?)<\/xmp\b[^>]*>/i],
                ["lang-js", /^<script\b[^>]*>([\s\S]*?)(<\/script\b[^>]*>)/i],
                ["lang-css", /^<style\b[^>]*>([\s\S]*?)(<\/style\b[^>]*>)/i],
                ["lang-in.tag", /^(<\/?[a-z][^<>]*>)/i]
            ]), ["default-markup", "htm", "html", "mxml", "xhtml", "xml", "xsl"]), s(n([
                [k, /^[\s]+/, null, " \t\r\n"],
                ["atv", /^(?:\"[^\"]*\"?|\'[^\']*\'?)/, null, "\"'"]
            ], [
                ["tag", /^^<\/?[a-z](?:[\w.:-]*\w)?|\/?>$/i],
                ["atn", /^(?!style[\s=]|on)[a-z](?:[\w:-]*\w)?/i],
                ["lang-uq.val", /^=\s*([^>\'\"\s]*(?:[^>\'\"\s\/]|\/(?=\s)))/],
                [L, /^[=<>\/]+/],
                ["lang-js", /^on\w+\s*=\s*\"([^\"]+)\"/i],
                ["lang-js", /^on\w+\s*=\s*\'([^\']+)\'/i],
                ["lang-js", /^on\w+\s*=\s*([^\"\'>\s]+)/i],
                ["lang-css", /^style\s*=\s*\"([^\"]+)\"/i],
                ["lang-css", /^style\s*=\s*\'([^\']+)\'/i],
                ["lang-css", /^style\s*=\s*([^\"\'>\s]+)/i]
            ]), ["in.tag"]), s(n([], [
                ["atv", /^[\s\S]+/]
            ]), ["uq.val"]), s(r({
                keywords: p,
                hashComments: !0,
                cStyleComments: !0,
                types: w
            }), ["c", "cc", "cpp", "cxx", "cyc", "m"]), s(r({
                keywords: "null,true,false"
            }), ["json"]), s(r({
                keywords: h,
                hashComments: !0,
                cStyleComments: !0,
                verbatimStrings: !0,
                types: w
            }), ["cs"]), s(r({
                keywords: g,
                cStyleComments: !0
            }), ["java"]), s(r({
                keywords: x,
                hashComments: !0,
                multiLineStrings: !0
            }), ["bash", "bsh", "csh", "sh"]), s(r({
                keywords: y,
                hashComments: !0,
                multiLineStrings: !0,
                tripleQuotedStrings: !0
            }), ["cv", "py", "python"]), s(r({
                keywords: v,
                hashComments: !0,
                multiLineStrings: !0,
                regexLiterals: 2
            }), ["perl", "pl", "pm"]), s(r({
                keywords: b,
                hashComments: !0,
                multiLineStrings: !0,
                regexLiterals: !0
            }), ["rb", "ruby"]), s(r({
                keywords: m,
                cStyleComments: !0,
                regexLiterals: !0
            }), ["javascript", "js", "ts", "typescript"]), s(r({
                keywords: "all,and,by,catch,class,else,extends,false,finally,for,if,in,is,isnt,loop,new,no,not,null,of,off,on,or,return,super,then,throw,true,try,unless,until,when,while,yes",
                hashComments: 3,
                cStyleComments: !0,
                multilineStrings: !0,
                tripleQuotedStrings: !0,
                regexLiterals: !0
            }), ["coffee"]), s(n([], [
                [S, /^[\s\S]+/]
            ]), ["regex"]);
            var $ = c.PR = {
                    createSimpleLexer: n,
                    registerLangHandler: s,
                    sourceDecorator: r,
                    PR_ATTRIB_NAME: "atn",
                    PR_ATTRIB_VALUE: "atv",
                    PR_COMMENT: N,
                    PR_DECLARATION: "dec",
                    PR_KEYWORD: C,
                    PR_LITERAL: E,
                    PR_NOCODE: "nocode",
                    PR_PLAIN: k,
                    PR_PUNCTUATION: L,
                    PR_SOURCE: A,
                    PR_STRING: S,
                    PR_TAG: "tag",
                    PR_TYPE: _,
                    prettyPrintOne: o,
                    prettyPrint: u
                },
                O = c.define;
            "function" == typeof O && O.amd && O("google-code-prettify", [], function() {
                return $
            })
        }()
    }, {}],
    2: [function(e, t, n) {
        "use strict";
        e("code-prettify"), window.addEventListener("load", function() {
            PR.prettyPrint();
            for (var e = document.querySelectorAll("ul.nav-tabs > li"), t = 0; t < e.length; t++) e[t].addEventListener("click", function(e) {
                e.preventDefault(), document.querySelector("ul.nav-tabs li.active").classList.remove("active"), document.querySelector(".tab-pane.active").classList.remove("active");
                var t = e.currentTarget,
                    n = e.target.getAttribute("href");
                t.classList.add("active"), document.querySelector(n).classList.add("active")
            })
        })
    }, {
        "code-prettify": 1
    }]
}, {}, [2]);