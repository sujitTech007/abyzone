(self.webpackChunk_N_E = self.webpackChunk_N_E || []).push([
    [974], {
        97430: (e, s, i) => {
            Promise.resolve().then(i.t.bind(i, 87970, 23)), Promise.resolve().then(i.t.bind(i, 44839, 23)), Promise.resolve().then(i.bind(i, 16605)), Promise.resolve().then(i.bind(i, 52182)), Promise.resolve().then(i.bind(i, 40766)), Promise.resolve().then(i.bind(i, 65565)), Promise.resolve().then(i.bind(i, 3386)), Promise.resolve().then(i.bind(i, 52303)), Promise.resolve().then(i.bind(i, 82764)), Promise.resolve().then(i.bind(i, 28771)), Promise.resolve().then(i.bind(i, 67198)), Promise.resolve().then(i.bind(i, 704)), Promise.resolve().then(i.bind(i, 77643)), Promise.resolve().then(i.bind(i, 49826)), Promise.resolve().then(i.bind(i, 78863)), Promise.resolve().then(i.bind(i, 79694)), Promise.resolve().then(i.bind(i, 4220)), Promise.resolve().then(i.bind(i, 29893)), Promise.resolve().then(i.bind(i, 41922)), Promise.resolve().then(i.bind(i, 56695)), Promise.resolve().then(i.bind(i, 6820)), Promise.resolve().then(i.bind(i, 42907)), Promise.resolve().then(i.bind(i, 20584)), Promise.resolve().then(i.bind(i, 43469)), Promise.resolve().then(i.bind(i, 16635)), Promise.resolve().then(i.bind(i, 1968)), Promise.resolve().then(i.bind(i, 42500)), Promise.resolve().then(i.bind(i, 74166)), Promise.resolve().then(i.bind(i, 71240)), Promise.resolve().then(i.bind(i, 1744)), Promise.resolve().then(i.bind(i, 51192)), Promise.resolve().then(i.bind(i, 5795)), Promise.resolve().then(i.bind(i, 38480)), Promise.resolve().then(i.bind(i, 92976)), Promise.resolve().then(i.bind(i, 58678)), Promise.resolve().then(i.bind(i, 68761)), Promise.resolve().then(i.bind(i, 76097)), Promise.resolve().then(i.bind(i, 76205)), Promise.resolve().then(i.bind(i, 2617))
        },
        68331: (e, s, i) => {
            "use strict";
            var a = i(12115),
                t = function(e) {
                    return e && "object" == typeof e && "default" in e ? e : {
                        default: e
                    }
                }(a);
            ! function(e) {
                if (!e || "undefined" == typeof window) return;
                let s = document.createElement("style");
                s.setAttribute("type", "text/css"), s.innerHTML = e, document.head.appendChild(s)
            }('.rfm-marquee-container {\n  overflow-x: hidden;\n  display: flex;\n  flex-direction: row;\n  position: relative;\n  width: var(--width);\n  transform: var(--transform);\n}\n.rfm-marquee-container:hover div {\n  animation-play-state: var(--pause-on-hover);\n}\n.rfm-marquee-container:active div {\n  animation-play-state: var(--pause-on-click);\n}\n\n.rfm-overlay {\n  position: absolute;\n  width: 100%;\n  height: 100%;\n}\n.rfm-overlay::before, .rfm-overlay::after {\n  background: linear-gradient(to right, var(--gradient-color), rgba(255, 255, 255, 0));\n  content: "";\n  height: 100%;\n  position: absolute;\n  width: var(--gradient-width);\n  z-index: 2;\n  pointer-events: none;\n  touch-action: none;\n}\n.rfm-overlay::after {\n  right: 0;\n  top: 0;\n  transform: rotateZ(180deg);\n}\n.rfm-overlay::before {\n  left: 0;\n  top: 0;\n}\n\n.rfm-marquee {\n  flex: 0 0 auto;\n  min-width: var(--min-width);\n  z-index: 1;\n  display: flex;\n  flex-direction: row;\n  align-items: center;\n  animation: scroll var(--duration) linear var(--delay) var(--iteration-count);\n  animation-play-state: var(--play);\n  animation-delay: var(--delay);\n  animation-direction: var(--direction);\n}\n@keyframes scroll {\n  0% {\n    transform: translateX(0%);\n  }\n  100% {\n    transform: translateX(-100%);\n  }\n}\n\n.rfm-initial-child-container {\n  flex: 0 0 auto;\n  display: flex;\n  min-width: auto;\n  flex-direction: row;\n  align-items: center;\n}\n\n.rfm-child {\n  transform: var(--transform);\n}');
            let l = a.forwardRef(function(e, s) {
                let {
                    style: i = {},
                    className: l = "",
                    autoFill: r = !1,
                    play: A = !0,
                    pauseOnHover: n = !1,
                    pauseOnClick: c = !1,
                    direction: d = "left",
                    speed: o = 50,
                    delay: h = 0,
                    loop: m = 0,
                    gradient: g = !1,
                    gradientColor: u = "white",
                    gradientWidth: x = 200,
                    onFinish: f,
                    onCycleComplete: j,
                    onMount: v,
                    children: p
                } = e, [b, w] = a.useState(0), [N, _] = a.useState(0), [E, C] = a.useState(1), [U, M] = a.useState(!1), R = a.useRef(null), B = s || R, y = a.useRef(null), k = a.useCallback(() => {
                    if (y.current && B.current) {
                        let e = B.current.getBoundingClientRect(),
                            s = y.current.getBoundingClientRect(),
                            i = e.width,
                            a = s.width;
                        ("up" === d || "down" === d) && (i = e.height, a = s.height), r && i && a ? C(a < i ? Math.ceil(i / a) : 1) : C(1), w(i), _(a)
                    }
                }, [r, B, d]);
                a.useEffect(() => {
                    if (U && (k(), y.current && B.current)) {
                        let e = new ResizeObserver(() => k());
                        return e.observe(B.current), e.observe(y.current), () => {
                            e && e.disconnect()
                        }
                    }
                }, [k, B, U]), a.useEffect(() => {
                    k()
                }, [k, p]), a.useEffect(() => {
                    M(!0)
                }, []), a.useEffect(() => {
                    "function" == typeof v && v()
                }, []);
                let S = a.useMemo(() => r ? N * E / o : N < b ? b / o : N / o, [r, b, N, E, o]),
                    P = a.useMemo(() => Object.assign(Object.assign({}, i), {
                        "--pause-on-hover": !A || n ? "paused" : "running",
                        "--pause-on-click": !A || n && !c || c ? "paused" : "running",
                        "--width": "up" === d || "down" === d ? "100vh" : "100%",
                        "--transform": "up" === d ? "rotate(-90deg)" : "down" === d ? "rotate(90deg)" : "none"
                    }), [i, A, n, c, d]),
                    D = a.useMemo(() => ({
                        "--gradient-color": u,
                        "--gradient-width": "number" == typeof x ? "".concat(x, "px") : x
                    }), [u, x]),
                    T = a.useMemo(() => ({
                        "--play": A ? "running" : "paused",
                        "--direction": "left" === d ? "normal" : "reverse",
                        "--duration": "".concat(S, "s"),
                        "--delay": "".concat(h, "s"),
                        "--iteration-count": m ? "".concat(m) : "infinite",
                        "--min-width": r ? "auto" : "100%"
                    }), [A, d, S, h, m, r]),
                    I = a.useMemo(() => ({
                        "--transform": "up" === d ? "rotate(90deg)" : "down" === d ? "rotate(-90deg)" : "none"
                    }), [d]),
                    L = a.useCallback(e => [...Array(Number.isFinite(e) && e >= 0 ? e : 0)].map((e, s) => t.default.createElement(a.Fragment, {
                        key: s
                    }, a.Children.map(p, e => t.default.createElement("div", {
                        style: I,
                        className: "rfm-child"
                    }, e)))), [I, p]);
                return U ? t.default.createElement("div", {
                    ref: B,
                    style: P,
                    className: "rfm-marquee-container " + l
                }, g && t.default.createElement("div", {
                    style: D,
                    className: "rfm-overlay"
                }), t.default.createElement("div", {
                    className: "rfm-marquee",
                    style: T,
                    onAnimationIteration: j,
                    onAnimationEnd: f
                }, t.default.createElement("div", {
                    className: "rfm-initial-child-container",
                    ref: y
                }, a.Children.map(p, e => t.default.createElement("div", {
                    style: I,
                    className: "rfm-child"
                }, e))), L(E - 1)), t.default.createElement("div", {
                    className: "rfm-marquee",
                    style: T
                }, L(E))) : null
            });
            s.A = l
        },
        1744: (e, s, i) => {
            "use strict";
            i.d(s, {
                default: () => n
            });
            var a = i(95155),
                t = i(5565),
                l = i(95083);
            let r = {
                    src: "/_next/static/media/achieved_img.febad7d1.png",
                    height: 566,
                    width: 579,
                    blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAUVBMVEVMaXEUg/gae+8ogexHZ5FCT2MDM8kVhP9gc6gUd/U6jPkUdfBQmv0RN70abd0me+kDNtMMcesDN80Kf/YsgfULdfMjgfs2hfAWiflIWWoTef3nRoi5AAAAGnRSTlMAfVAoEzLp/gX++9z9SqE88v2Lvuqe37ZkInzYAcoAAAAJcEhZcwAACxMAAAsTAQCanBgAAAA/SURBVHicJcZHDsAgEATBIc4u4BxA/P+hCLsvXQDgA2YyIR//Lauxm/OCqOyqd0U8mFIpL3ZlJ5lx5usxzboBL8MB8ZBp1PYAAAAASUVORK5CYII=",
                    blurWidth: 8,
                    blurHeight: 8
                },
                A = {
                    src: "/_next/static/media/achieved_shape.274d386b.png",
                    height: 547,
                    width: 1093,
                    blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAECAMAAACEE47CAAAACVBMVEXU1NTb29vU1NSOsLFDAAAAA3RSTlMMAh2iXDPhAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAHklEQVR4nCXGwQkAAAyDQHX/oUuJ3EMoVlCJe/GJBwG+ABiM9vOiAAAAAElFTkSuQmCC",
                    blurWidth: 8,
                    blurHeight: 4
                },
                n = () => {
                    let [e, s] = (0, l.Wx)({
                        triggerOnce: !0,
                        threshold: .75
                    });
                    return (0, a.jsxs)("section", {
                        className: "achieved__area fix",
                        children: [(0, a.jsx)("div", {
                            className: "container",
                            children: (0, a.jsxs)("div", {
                                className: "row justify-content-center",
                                children: [(0, a.jsx)("div", {
                                    className: "col-lg-6 col-md-10 order-0 order-lg-2",
                                    children: (0, a.jsx)("div", {
                                        className: "achieved__img",
                                        children: (0, a.jsx)(t.default, {
                                            src: r,
                                            alt: "img",
                                            className: "wow bounceInDown",
                                            "data-wow-delay": ".3s"
                                        })
                                    })
                                }), (0, a.jsx)("div", {
                                    className: "col-lg-6",
                                    children: (0, a.jsxs)("div", {
                                        className: "achieved__content",
                                        children: [(0, a.jsxs)("div", {
                                            className: "section__title mb-20",
                                            children: [(0, a.jsx)("span", {
                                                className: "sub-title",
                                                children: "What We Achieved!"
                                            }), (0, a.jsx)("h2", {
                                                className: "title",
                                                children: "We are logistics improving our skills to fulfill delivery of any level!"
                                            })]
                                        }), (0, a.jsx)("p", {
                                            children: "Adipiscing elit. Aliquam vulputate, tortor nec com ultri viverra Suspen disse faucibus sed dolor eget Sed id urna. hiftler Group irepresentatilve in loisticsti"
                                        }), (0, a.jsxs)("div", {
                                            className: "progress__wrap",
                                            ref: e,
                                            children: [(0, a.jsxs)("div", {
                                                className: "progress__item",
                                                children: [(0, a.jsxs)("div", {
                                                    className: "progress__item-top",
                                                    children: [(0, a.jsx)("h3", {
                                                        className: "progress__title",
                                                        children: "Successful Delivery"
                                                    }), (0, a.jsxs)("div", {
                                                        className: "progress-value",
                                                        children: [(0, a.jsx)("span", {
                                                            className: "counter-number",
                                                            children: "82"
                                                        }), "%"]
                                                    })]
                                                }), (0, a.jsx)("div", {
                                                    className: "progress",
                                                    children: (0, a.jsx)("div", {
                                                        className: "progress-bar",
                                                        style: {
                                                            width: "82%",
                                                            animation: s ? "animate-positive 1.8s" : "none",
                                                            opacity: s ? "1" : "0"
                                                        }
                                                    })
                                                })]
                                            }), (0, a.jsxs)("div", {
                                                className: "progress__item",
                                                children: [(0, a.jsxs)("div", {
                                                    className: "progress__item-top",
                                                    children: [(0, a.jsx)("h3", {
                                                        className: "progress__title",
                                                        children: "Happy Customers"
                                                    }), (0, a.jsxs)("div", {
                                                        className: "progress-value",
                                                        children: [(0, a.jsx)("span", {
                                                            className: "counter-number",
                                                            children: "90"
                                                        }), "%"]
                                                    })]
                                                }), (0, a.jsx)("div", {
                                                    className: "progress",
                                                    children: (0, a.jsx)("div", {
                                                        className: "progress-bar",
                                                        style: {
                                                            width: "90%",
                                                            animation: s ? "animate-positive 1.8s" : "none",
                                                            opacity: s ? "1" : "0"
                                                        }
                                                    })
                                                })]
                                            })]
                                        })]
                                    })
                                })]
                            })
                        }), (0, a.jsx)("div", {
                            className: "achieved__shape",
                            children: (0, a.jsx)(t.default, {
                                src: A,
                                alt: "shape"
                            })
                        })]
                    })
                }
        },
        5795: (e, s, i) => {
            "use strict";
            i.d(s, {
                default: () => c
            });
            var a = i(95155),
                t = i(67396),
                l = i(68331),
                r = i(12115),
                A = i(74166);
            let n = ["Air Freight", "Logistics", "Delivery Service", "Tracking", "Warehouse"],
                c = e => {
                    let {
                        style: s
                    } = e, [i, c] = (0, r.useState)(!1);
                    return (0, a.jsx)("section", {
                        className: "marquee__area fix",
                        children: (0, a.jsx)("div", {
                            className: "container-fluid p-0",
                            children: (0, a.jsx)("div", {
                                className: "slider__marquee clearfix marquee-wrap",
                                children: (0, a.jsx)(l.A, {
                                    className: "marquee_mode marquee__group",
                                    pauseOnHover: !1,
                                    play: !i,
                                    children: n.map((e, i) => (0, a.jsx)("h6", {
                                        className: "marquee__item ".concat(s ? "marquee__item-three" : ""),
                                        onMouseEnter: () => c(!0),
                                        onMouseLeave: () => c(!1),
                                        children: (0, a.jsxs)(t.default, {
                                            href: "/services",
                                            children: [(0, a.jsx)(A.default, {
                                                src: "/assets/img/icon/star.svg",
                                                alt: "",
                                                className: "injectable"
                                            }), " ", e]
                                        })
                                    }, i))
                                })
                            })
                        })
                    })
                }
        },
        38480: (e, s, i) => {
            "use strict";
            i.d(s, {
                default: () => g
            });
            var a = i(95155),
                t = i(1247),
                l = i(74166),
                r = i(5565),
                A = i(67396),
                n = i(25999),
                c = i(18651),
                d = i(43684),
                o = i(20905);
            let h = [{
                    id: 1,
                    img: c.default,
                    title: "Modern Warehouse",
                    tag: "Logistics"
                }, {
                    id: 2,
                    img: d.default,
                    title: "Modern Warehouse",
                    tag: "Logistics"
                }, {
                    id: 3,
                    img: o.default,
                    title: "Modern Warehouse",
                    tag: "Logistics"
                }, {
                    id: 4,
                    img: d.default,
                    title: "Modern Warehouse",
                    tag: "Logistics"
                }],
                m = {
                    slidesPerView: 3,
                    loop: !0,
                    spaceBetween: 24,
                    observer: !0,
                    observeParents: !0,
                    autoplay: !1,
                    centeredSlides: !0,
                    breakpoints: {
                        1500: {
                            slidesPerView: 3
                        },
                        1200: {
                            slidesPerView: 3
                        },
                        992: {
                            slidesPerView: 3
                        },
                        768: {
                            slidesPerView: 3
                        },
                        576: {
                            slidesPerView: 1.3
                        },
                        0: {
                            slidesPerView: 1
                        }
                    },
                    pagination: {
                        el: ".project__nav",
                        clickable: !0
                    }
                },
                g = () => (0, a.jsxs)("section", {
                    className: "project__area project__bg",
                    style: {
                        backgroundImage: "url(/assets/img/bg/vector_bg02.svg)"
                    },
                    children: [(0, a.jsx)("div", {
                        className: "container",
                        children: (0, a.jsxs)("div", {
                            className: "row align-items-end",
                            children: [(0, a.jsx)("div", {
                                className: "col-lg-7 col-md-9",
                                children: (0, a.jsxs)("div", {
                                    className: "section__title mb-40",
                                    children: [(0, a.jsx)("span", {
                                        className: "sub-title",
                                        children: "Featured Projects"
                                    }), (0, a.jsx)("h2", {
                                        className: "title",
                                        children: "We Are Proud to Excellence Deliver Success"
                                    })]
                                })
                            }), (0, a.jsx)("div", {
                                className: "col-lg-5 col-md-3",
                                children: (0, a.jsx)("div", {
                                    className: "view-all-btn text-end mb-60",
                                    children: (0, a.jsxs)(A.default, {
                                        href: "/services-details",
                                        className: "btn",
                                        children: ["See All Projects ", (0, a.jsx)(l.default, {
                                            src: "/assets/img/icon/right_arrow.svg",
                                            alt: "",
                                            className: "injectable"
                                        })]
                                    })
                                })
                            })]
                        })
                    }), (0, a.jsx)("div", {
                        className: "container-fluid p-0 fix",
                        children: (0, a.jsx)("div", {
                            className: "project__item-wrap",
                            children: (0, a.jsxs)(t.RC, {
                                ...m,
                                modules: [n.dK],
                                className: " project-active",
                                children: [h.map(e => (0, a.jsx)(t.qr, {
                                    className: "swiper-slide",
                                    children: (0, a.jsxs)("div", {
                                        className: "project__item",
                                        children: [(0, a.jsx)("div", {
                                            className: "project__thumb",
                                            children: (0, a.jsx)(A.default, {
                                                href: "/project-details",
                                                children: (0, a.jsx)(r.default, {
                                                    src: e.img,
                                                    alt: "img"
                                                })
                                            })
                                        }), (0, a.jsxs)("div", {
                                            className: "project__content",
                                            children: [(0, a.jsxs)("div", {
                                                className: "content",
                                                children: [(0, a.jsx)("h2", {
                                                    className: "title",
                                                    children: (0, a.jsx)(A.default, {
                                                        href: "/project-details",
                                                        children: e.title
                                                    })
                                                }), (0, a.jsx)("span", {
                                                    children: e.tag
                                                })]
                                            }), (0, a.jsx)("div", {
                                                className: "right-arrow",
                                                children: (0, a.jsx)(A.default, {
                                                    href: "/project-details",
                                                    children: (0, a.jsx)(l.default, {
                                                        src: "/assets/img/icon/right_arrow.svg",
                                                        alt: "",
                                                        className: "injectable"
                                                    })
                                                })
                                            })]
                                        })]
                                    })
                                }, e.id)), (0, a.jsx)("div", {
                                    className: "project__nav"
                                })]
                            })
                        })
                    })]
                })
        },
        76097: (e, s, i) => {
            "use strict";
            i.d(s, {
                default: () => o
            });
            var a = i(95155),
                t = i(74166),
                l = i(5565),
                r = i(67396);
            let A = {
                    src: "/_next/static/media/cta_shape.9f6c17fe.png",
                    height: 108,
                    width: 113,
                    blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAElBMVEUcNJ0bM5wAJqUcNJwcNJodNqFk1djGAAAABnRSTlMqOwFPHhFj6xrjAAAACXBIWXMAAAsTAAALEwEAmpwYAAAALklEQVR4nB3KuQ0AMBCEQPbrv2XrjAiH2fYSAuWqKhVjS8vCSnUnX5gmns6QY34TfgCDsOxOsQAAAABJRU5ErkJggg==",
                    blurWidth: 8,
                    blurHeight: 8
                },
                n = {
                    src: "/_next/static/media/footer_shape01.2768e78c.png",
                    height: 219,
                    width: 226,
                    blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAHlBMVEUSEj0RET4RETxMaXESEj4RET4SEj8AACgRET4REUQaUF8LAAAACnRSTlNgQHkAKjhRAkYPvgUJCAAAAAlwSFlzAAALEwAACxMBAJqcGAAAADBJREFUeJxFxlEKACAQAlFLXbf7XziKoMd8DBjaIZEQxQRckrSIhiWjcLrK4+g/89kkOADbFSxaLwAAAABJRU5ErkJggg==",
                    blurWidth: 8,
                    blurHeight: 8
                },
                c = {
                    src: "/_next/static/media/footer_shape02.477f199b.png",
                    height: 230,
                    width: 212,
                    blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAICAMAAAAC2hU0AAAAHlBMVEURET4RET4RET8SEj5MaXESEjsQED0RET0AAAARET3x4dFxAAAACnRSTlNXSBNmADwkKwGE2yfZxgAAAAlwSFlzAAALEwAACxMBAJqcGAAAADBJREFUeJwVxsERACAIA8FLCKD9N+y4ryU5WYf0BIWURJmgyZqj1mBc0LX4XvGPBDwYLQCq3cls9wAAAABJRU5ErkJggg==",
                    blurWidth: 7,
                    blurHeight: 8
                };
            var d = i(67192);
            let o = () => (0, a.jsxs)("footer", {
                className: "footer__area fix",
                children: [(0, a.jsxs)("div", {
                    className: "container",
                    children: [(0, a.jsxs)("div", {
                        className: "cta__wrap fix",
                        children: [(0, a.jsxs)("div", {
                            className: "row align-items-center",
                            children: [(0, a.jsx)("div", {
                                className: "col-lg-7",
                                children: (0, a.jsx)("div", {
                                    className: "cta__content",
                                    children: (0, a.jsxs)("h3", {
                                        className: "title",
                                        children: ["Fastest & secure way to transport ", (0, a.jsx)("br", {}), " anything anytime"]
                                    })
                                })
                            }), (0, a.jsx)("div", {
                                className: "col-lg-5",
                                children: (0, a.jsx)("div", {
                                    className: "cta__btn text-end",
                                    children: (0, a.jsxs)(r.default, {
                                        href: "/services",
                                        className: "btn btn-two",
                                        children: ["Request a Quote ", (0, a.jsx)(t.default, {
                                            src: "assets/img/icon/right_arrow.svg",
                                            alt: "",
                                            className: "injectable"
                                        })]
                                    })
                                })
                            })]
                        }), (0, a.jsx)("div", {
                            className: "cta__shape",
                            children: (0, a.jsx)(l.default, {
                                src: A,
                                alt: "img",
                                "data-aos": "fade-up-right",
                                "data-aos-delay": "400"
                            })
                        })]
                    }), (0, a.jsx)("div", {
                        className: "footer__top",
                        children: (0, a.jsxs)("div", {
                            className: "row",
                            children: [(0, a.jsx)("div", {
                                className: "col-xl-4 col-lg-5 col-md-6",
                                children: (0, a.jsxs)("div", {
                                    className: "footer__widget",
                                    children: [(0, a.jsx)("div", {
                                        className: "footer__logo",
                                        children: (0, a.jsx)(r.default, {
                                            href: "/",
                                            children: (0, a.jsx)(l.default, {
                                                src: d.default,
                                                alt: "logo"
                                            })
                                        })
                                    }), (0, a.jsx)("div", {
                                        className: "footer__content",
                                        children: (0, a.jsx)("p", {
                                            children: "Lorem ipsum dolor sit amet, consect etur adi pisicing elit sed do eiusmod tempor incidunt ut labore et"
                                        })
                                    }), (0, a.jsxs)("form", {
                                        onSubmit: e => e.preventDefault(),
                                        className: "footer__newsletter",
                                        children: [(0, a.jsxs)("div", {
                                            className: "form-grp",
                                            children: [(0, a.jsx)("input", {
                                                type: "email",
                                                placeholder: "enter your e-mail"
                                            }), (0, a.jsx)("button", {
                                                type: "submit",
                                                children: "Subscribe"
                                            })]
                                        }), (0, a.jsx)("span", {
                                            children: "We don’t send you any spam"
                                        })]
                                    })]
                                })
                            }), (0, a.jsx)("div", {
                                className: "col-xl-2 col-lg-4 col-md-6 col-sm-6",
                                children: (0, a.jsxs)("div", {
                                    className: "footer__widget",
                                    children: [(0, a.jsx)("h4", {
                                        className: "footer__widget-title",
                                        children: "Our Services"
                                    }), (0, a.jsx)("div", {
                                        className: "footer__link",
                                        children: (0, a.jsxs)("ul", {
                                            className: "list-wrap",
                                            children: [(0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/services-details",
                                                    children: "Air Freight"
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/services-details",
                                                    children: "Smart Warehousing"
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/services-details",
                                                    children: "Train Freight"
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/services-details",
                                                    children: "Ocean Fright"
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/services-details",
                                                    children: "Road Freight"
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/services-details",
                                                    children: "Supply Chain"
                                                })
                                            })]
                                        })
                                    })]
                                })
                            }), (0, a.jsx)("div", {
                                className: "col-xl-3 col-lg-3 col-md-6 col-sm-6",
                                children: (0, a.jsxs)("div", {
                                    className: "footer__widget",
                                    children: [(0, a.jsx)("h4", {
                                        className: "footer__widget-title",
                                        children: "Quick Links"
                                    }), (0, a.jsx)("div", {
                                        className: "footer__link",
                                        children: (0, a.jsxs)("ul", {
                                            className: "list-wrap",
                                            children: [(0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/how-it-work",
                                                    children: "How it’s Work"
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/client",
                                                    children: "Partners"
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/testimonial",
                                                    children: "Testimonials"
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/project",
                                                    children: "Case Studies"
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(r.default, {
                                                    href: "/pricing",
                                                    children: "Pricing"
                                                })
                                            })]
                                        })
                                    })]
                                })
                            }), (0, a.jsx)("div", {
                                className: "col-xl-3 col-lg-4 col-md-6",
                                children: (0, a.jsxs)("div", {
                                    className: "footer__widget",
                                    children: [(0, a.jsx)("h4", {
                                        className: "footer__widget-title",
                                        children: "Information"
                                    }), (0, a.jsx)("div", {
                                        className: "footer__info-wrap",
                                        children: (0, a.jsxs)("ul", {
                                            className: "list-wrap",
                                            children: [(0, a.jsxs)("li", {
                                                children: [(0, a.jsx)("i", {
                                                    className: "flaticon-location-1"
                                                }), (0, a.jsxs)("p", {
                                                    children: ["58 Street Commercial Road ", (0, a.jsx)("br", {}), " Fratton, Australia"]
                                                })]
                                            }), (0, a.jsxs)("li", {
                                                children: [(0, a.jsx)("i", {
                                                    className: "flaticon-telephone"
                                                }), (0, a.jsx)(r.default, {
                                                    href: "tel:0123456789",
                                                    children: "+123 888 9999"
                                                })]
                                            }), (0, a.jsxs)("li", {
                                                children: [(0, a.jsx)("i", {
                                                    className: "flaticon-time"
                                                }), (0, a.jsxs)("p", {
                                                    children: ["Mon – Sat: 8 am – 5 pm, ", (0, a.jsx)("br", {}), " Sunday: ", (0, a.jsx)("span", {
                                                        children: "CLOSED"
                                                    })]
                                                })]
                                            })]
                                        })
                                    })]
                                })
                            })]
                        })
                    }), (0, a.jsx)("div", {
                        className: "footer__bottom",
                        children: (0, a.jsxs)("div", {
                            className: "row align-items-center",
                            children: [(0, a.jsx)("div", {
                                className: "col-md-7",
                                children: (0, a.jsx)("div", {
                                    className: "copyright-text",
                                    children: (0, a.jsxs)("p", {
                                        children: ["Copyright ", (0, a.jsx)(r.default, {
                                            href: "/",
                                            children: "\xa9logistex"
                                        }), " | All Right Reserved"]
                                    })
                                })
                            }), (0, a.jsx)("div", {
                                className: "col-md-5",
                                children: (0, a.jsx)("div", {
                                    className: "footer__social",
                                    children: (0, a.jsxs)("ul", {
                                        className: "list-wrap",
                                        children: [(0, a.jsx)("li", {
                                            children: (0, a.jsx)(r.default, {
                                                href: "https://www.facebook.com/",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-facebook-f"
                                                })
                                            })
                                        }), (0, a.jsx)("li", {
                                            children: (0, a.jsx)(r.default, {
                                                href: "https://twitter.com",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-twitter"
                                                })
                                            })
                                        }), (0, a.jsx)("li", {
                                            children: (0, a.jsx)(r.default, {
                                                href: "https://www.whatsapp.com/",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-whatsapp"
                                                })
                                            })
                                        }), (0, a.jsx)("li", {
                                            children: (0, a.jsx)(r.default, {
                                                href: "https://www.instagram.com/",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-instagram"
                                                })
                                            })
                                        }), (0, a.jsx)("li", {
                                            children: (0, a.jsx)(r.default, {
                                                href: "https://www.youtube.com/",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-youtube"
                                                })
                                            })
                                        })]
                                    })
                                })
                            })]
                        })
                    })]
                }), (0, a.jsxs)("div", {
                    className: "footer__shape",
                    children: [(0, a.jsx)(l.default, {
                        src: n,
                        alt: "shape",
                        "data-aos": "fade-down",
                        "data-aos-delay": "400"
                    }), (0, a.jsx)(l.default, {
                        src: c,
                        alt: "shape",
                        "data-aos": "fade-left",
                        "data-aos-delay": "400"
                    })]
                })]
            })
        },
        76205: (e, s, i) => {
            "use strict";
            i.d(s, {
                default: () => g
            });
            var a = i(95155),
                t = i(67396),
                l = i(91553),
                r = i(5565);
            let A = () => (0, a.jsx)("div", {
                className: "tg-header__top",
                children: (0, a.jsx)("div", {
                    className: "container-fluid p-0",
                    children: (0, a.jsxs)("div", {
                        className: "row align-items-center",
                        children: [(0, a.jsx)("div", {
                            className: "col-xl-7",
                            children: (0, a.jsxs)("ul", {
                                className: "tg-header__top-info left-side list-wrap",
                                children: [(0, a.jsxs)("li", {
                                    children: [(0, a.jsx)("i", {
                                        className: "flaticon-location-1"
                                    }), "775 Rolling Green Rd"]
                                }), (0, a.jsxs)("li", {
                                    children: [(0, a.jsx)("i", {
                                        className: "flaticon-envelope"
                                    }), (0, a.jsx)(t.default, {
                                        href: "mailto:info@gmail.com",
                                        children: "bill.sanders@example.com"
                                    })]
                                }), (0, a.jsxs)("li", {
                                    children: [(0, a.jsx)("i", {
                                        className: "flaticon-time"
                                    }), "Mon – Sun: 9.00 am – 8.00pm"]
                                })]
                            })
                        }), (0, a.jsx)("div", {
                            className: "col-xl-5",
                            children: (0, a.jsxs)("div", {
                                className: "tg-header__top-right",
                                children: [(0, a.jsxs)("ul", {
                                    className: "tg-header__top-menu list-wrap",
                                    children: [(0, a.jsx)("li", {
                                        children: (0, a.jsx)(t.default, {
                                            href: "/contact",
                                            children: "Help Center"
                                        })
                                    }), (0, a.jsx)("li", {
                                        children: (0, a.jsx)(t.default, {
                                            href: "/contact",
                                            children: "Find Store"
                                        })
                                    })]
                                }), (0, a.jsxs)("div", {
                                    className: "tg-header__top-social",
                                    children: [(0, a.jsx)("span", {
                                        children: "Follow Us On:"
                                    }), (0, a.jsxs)("ul", {
                                        className: "list-wrap",
                                        children: [(0, a.jsx)("li", {
                                            children: (0, a.jsx)(t.default, {
                                                href: "https://www.facebook.com/",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-facebook-f"
                                                })
                                            })
                                        }), (0, a.jsx)("li", {
                                            children: (0, a.jsx)(t.default, {
                                                href: "https://twitter.com",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-twitter"
                                                })
                                            })
                                        }), (0, a.jsx)("li", {
                                            children: (0, a.jsx)(t.default, {
                                                href: "https://www.whatsapp.com/",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-whatsapp"
                                                })
                                            })
                                        }), (0, a.jsx)("li", {
                                            children: (0, a.jsx)(t.default, {
                                                href: "https://www.instagram.com/",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-instagram"
                                                })
                                            })
                                        }), (0, a.jsx)("li", {
                                            children: (0, a.jsx)(t.default, {
                                                href: "https://www.youtube.com/",
                                                target: "_blank",
                                                children: (0, a.jsx)("i", {
                                                    className: "fab fa-youtube"
                                                })
                                            })
                                        })]
                                    })]
                                })]
                            })
                        })]
                    })
                })
            });
            var n = i(99733),
                c = i(12115),
                d = i(71598),
                o = i(39584),
                h = i(98651),
                m = i(60949);
            let g = () => {
                let {
                    sticky: e
                } = (0, n.A)(), [s, i] = (0, c.useState)(!1), [g, u] = (0, c.useState)(!1), [x, f] = (0, c.useState)(!1);
                return (0, a.jsxs)("header", {
                    children: [(0, a.jsx)("div", {
                        id: "header-fixed-height"
                    }), (0, a.jsx)(A, {}), (0, a.jsx)("div", {
                        id: "sticky-header",
                        className: "tg-header__area ".concat(e ? "tg-sticky-menu sticky-menu sticky-menu__show" : ""),
                        children: (0, a.jsx)("div", {
                            className: "container-fluid p-0",
                            children: (0, a.jsx)("div", {
                                className: "row gx-0",
                                children: (0, a.jsx)("div", {
                                    className: "col-12",
                                    children: (0, a.jsxs)("div", {
                                        className: "tgmenu__wrap",
                                        children: [(0, a.jsxs)("div", {
                                            className: "tgmenu__nav-left-side",
                                            children: [(0, a.jsx)("div", {
                                                className: "offcanvas-toggle",
                                                children: (0, a.jsx)(t.default, {
                                                    href: "#",
                                                    onClick: () => i(!0),
                                                    className: "menu-tigger",
                                                    children: (0, a.jsx)("svg", {
                                                        xmlns: "http://www.w3.org/2000/svg",
                                                        width: "30",
                                                        height: "30",
                                                        viewBox: "0 0 30 30",
                                                        fill: "none",
                                                        children: (0, a.jsx)("path", {
                                                            d: "M1.66669 15H28.3334M1.66669 6.66666H28.3334M1.66669 23.3333H28.3334",
                                                            stroke: "currentcolor",
                                                            strokeWidth: "1.83333",
                                                            strokeLinecap: "round",
                                                            strokeLinejoin: "round"
                                                        })
                                                    })
                                                })
                                            }), (0, a.jsx)("div", {
                                                className: "logo",
                                                children: (0, a.jsx)(t.default, {
                                                    href: "/",
                                                    children: (0, a.jsx)(r.default, {
                                                        src: m.A,
                                                        alt: "Logo"
                                                    })
                                                })
                                            })]
                                        }), (0, a.jsx)("div", {
                                            className: "tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex",
                                            children: (0, a.jsx)(l.A, {})
                                        }), (0, a.jsx)("div", {
                                            className: "tgmenu__action d-none d-md-flex",
                                            children: (0, a.jsxs)("ul", {
                                                className: "list-wrap",
                                                children: [(0, a.jsx)("li", {
                                                    className: "header-search",
                                                    children: (0, a.jsx)("a", {
                                                        onClick: () => u(!0),
                                                        style: {
                                                            cursor: "pointer"
                                                        },
                                                        className: "search-open-btn",
                                                        children: (0, a.jsx)("i", {
                                                            className: "flaticon-search"
                                                        })
                                                    })
                                                }), (0, a.jsxs)("li", {
                                                    className: "header-contact",
                                                    children: [(0, a.jsx)("div", {
                                                        className: "icon",
                                                        children: (0, a.jsx)("i", {
                                                            className: "flaticon-telephone"
                                                        })
                                                    }), (0, a.jsxs)("div", {
                                                        className: "content",
                                                        children: [(0, a.jsx)("span", {
                                                            children: "Emergency Call:"
                                                        }), (0, a.jsx)(t.default, {
                                                            href: "tel:0123456789",
                                                            children: "(205) 555-0100"
                                                        })]
                                                    })]
                                                }), (0, a.jsx)("li", {
                                                    className: "header-btn",
                                                    children: (0, a.jsxs)(t.default, {
                                                        href: "/contact",
                                                        className: "btn",
                                                        children: [(0, a.jsx)("i", {
                                                            className: "flaticon-uptrend"
                                                        }), "Track Order"]
                                                    })
                                                })]
                                            })
                                        }), (0, a.jsx)("div", {
                                            className: "mobile-nav-toggler",
                                            onClick: () => f(!0),
                                            children: (0, a.jsx)("i", {
                                                className: "tg-flaticon-menu-1"
                                            })
                                        })]
                                    })
                                })
                            })
                        })
                    }), (0, a.jsx)(d.A, {
                        offCanvas: s,
                        setOffCanvas: i
                    }), (0, a.jsx)(o.A, {
                        isSearch: g,
                        setIsSearch: u
                    }), (0, a.jsx)(h.A, {
                        isActive: x,
                        setIsActive: f
                    })]
                })
            }
        },
        16605: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/banner_img01.3e27d8b5.png",
                height: 566,
                width: 586,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAb1BMVEWAb5gZY7WwgHCZZkzdvJ3ctpYQX7cAgvAHOIDAimu3hnJ+b3UVh+kRc8uGc3cAd+L/xoWabmJHl9iXUCbFvLEVgtlwqtYqarJ8lLDx7uL/79T18uT63b4CctoCU7L///IAWsSer8cOj/Odr79ueI9v1ZxeAAAAIXRSTlMB3q8U+/mOGHTR/ay6d/JRO+n8nqXv/v3+/v3+5f/+//6eeNYXAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAQklEQVR4nCXGRQKAIAAAwVVBwO4mjP+/0QNzGiBPiNIiiymbVgGqsvaZp476Huyy+wvTr2E7TsGoXXi9l6Cd+6QwP1vYA5ACdG/5AAAAAElFTkSuQmCC",
                blurWidth: 8,
                blurHeight: 8
            }
        },
        52182: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/banner_img02.85bfcdcc.png",
                height: 492,
                width: 459,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAICAMAAAAC2hU0AAAAPFBMVEVXbLMTd/QWePUlhPQTevYFQtQld+Mkhf5LXG5NdbY1Q1UIP8wRefcERNIUdPIKePATg/kOgfw6kP1Tnf++1mgQAAAAEXRSTlMBvKCE/vVA/g4bOdXrqNTYXWEBGSgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAA3SURBVHicLYdBEoAgDMSW0rJWVKD+/68MYi5JAODA5vzDl734N1WvJ0mGKSNewsYgqbhbktzLBBt6ATmSwbjXAAAAAElFTkSuQmCC",
                blurWidth: 7,
                blurHeight: 8
            }
        },
        40766: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/banner_shape.c3cfb7f8.png",
                height: 520,
                width: 506,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAACVBMVEW6xcu8yMy9ycxv74+UAAAAA3RSTlMGKxns4O3FAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAKUlEQVR4nDWLQQ4AMAyCkP8/erHtvECMAigbE8GylmFETiAtK3b2f/AACFcAOfPK8K0AAAAASUVORK5CYII=",
                blurWidth: 8,
                blurHeight: 8
            }
        },
        704: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/about_img01.d14a35ec.png",
                height: 534,
                width: 560,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAXVBMVEWnz9k7VnfH2e/x9/8zRmXb5vcOJkJMaXE5YIQwUHAeOmIyVIdfgLI6Xn8sWYBqe5SqtMMjS3EIEzSivuM7ZJz///88ZKBBaaKJqdyTseCAnsyjveZviqooP16FocKZwGOXAAAAGXRSTlME/X1T/P1WAP79/v3+RmF8wrLnU/w6+/zsh4xXngAAAAlwSFlzAAALEwAACxMBAJqcGAAAAERJREFUeJwdyEkSgCAMBMARCWFT3DWA/v+ZFN66Gk8pdDIYkoXGjhii7Azgvo78T/C+LkkpGLNa934E8GwH7TTAU8fWAHIIAtJ7UwkQAAAAAElFTkSuQmCC",
                blurWidth: 8,
                blurHeight: 8
            }
        },
        77643: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/about_img02.fe9ba718.png",
                height: 163,
                width: 175,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAHCAMAAAACh/xsAAAAZlBMVEUBcJyZRXUaPGVzXGcCYI46cYoAV4kAQ3YAZ5QNbY0OXIOoaGkdh5eEdXv6mHMAS4CAaWTpPVAAcJSITXcRPW8WTHyrTF+9ZFDdV0oXR3MFcYunbjGJYVl6XYnGgFpceIJte5MIcpYvdjUMAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAPklEQVR4nBXBBRLAMAwDMBedtB0z7/+v3E0CSTbRe9htGi2j4HLLPJhKcZ/Haro6ID9vdm0QaEp7DxGUovh9VTwCjTn+cz8AAAAASUVORK5CYII=",
                blurWidth: 8,
                blurHeight: 7
            }
        },
        49826: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/about_img03.d8c8db6a.png",
                height: 285,
                width: 244,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAICAMAAAAC2hU0AAAAXVBMVEXq6eU3SWDe4Nx5j6hdb4NCYoebmZHj49+uqqGqoprCurIlRWYiLToiNk6Dh5FDQT3Fycnm39JmjL1njb2nuM1sg5wxPEiQkYuIhIUtTWyGj59Jbp84YpdOXnP58+iFqZz+AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAP0lEQVR4nAXBBwLAIAgEsEMFxd29+/9nmgAw3nuDKdp5WX9osMwbEIJLyXUc4l5+Olr7rkwC2nMppLhrPUXjAEhNAoL0UGXmAAAAAElFTkSuQmCC",
                blurWidth: 7,
                blurHeight: 8
            }
        },
        78863: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/about_shape.86f57094.png",
                height: 235,
                width: 236,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAFVBMVEXy8/Px8/Pz9fXy8fH09PTy8vLMu7sAKQmeAAAAB3RSTlM3QBdJKFsD9TzlsAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAC9JREFUeJwVxrENADAMwzDJcfL/yUUXgqSzOw1AP7iDswP+KAYl4gVyEi49QhW0DxIeAHz3T32SAAAAAElFTkSuQmCC",
                blurWidth: 8,
                blurHeight: 8
            }
        },
        4220: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/choose_img01.42e5756d.jpg",
                height: 476,
                width: 580,
                blurDataURL: "data:image/jpeg;base64,/9j/2wBDAAoKCgoKCgsMDAsPEA4QDxYUExMUFiIYGhgaGCIzICUgICUgMy03LCksNy1RQDg4QFFeT0pPXnFlZXGPiI+7u/v/2wBDAQoKCgoKCgsMDAsPEA4QDxYUExMUFiIYGhgaGCIzICUgICUgMy03LCksNy1RQDg4QFFeT0pPXnFlZXGPiI+7u/v/wgARCAAHAAgDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAP/xAAVAQEBAAAAAAAAAAAAAAAAAAABA//aAAwDAQACEAMQAAAAuC3/xAAaEAADAQADAAAAAAAAAAAAAAABAgMRAAQF/9oACAEBAAE/ALep36tRpszR0nDmjn//xAAWEQEBAQAAAAAAAAAAAAAAAAABEQD/2gAIAQIBAT8AGBN//8QAGBEBAQADAAAAAAAAAAAAAAAAAQIAEiH/2gAIAQMBAT8AskqjUe5//9k=",
                blurWidth: 8,
                blurHeight: 7
            }
        },
        16635: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/services_shape01.7c34bfd8.png",
                height: 200,
                width: 201,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAIVBMVEXi7vDh6+7g7O/h7O7g6+3g6/RMaXHi7PDh7O3g6+3h6+2cC6YpAAAAC3RSTlM2RyZlThcAP4tXdKkcMKgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAA3SURBVHicFcnJEcBACAPBkYDlyD9gl/vbPO/M+uGjxS1RkuQgCqCDcBOq+6tTtWQk4sxzzqTfByUbAP9BTzTPAAAAAElFTkSuQmCC",
                blurWidth: 8,
                blurHeight: 8
            }
        },
        1968: (e, s, i) => {
            "use strict";
            i.r(s), i.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/services_shape02.b62b75f9.png",
                height: 192,
                width: 191,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAHlBMVEXg7O7i7e/h7O3k7/Hi7e/h7O7///9MaXHn5+fU6em9dKEAAAAACnRSTlNiUyg1c0YDAAsMn1eqCAAAAAlwSFlzAAALEwAACxMBAJqcGAAAADJJREFUeJwdyskNgDAABLHZK4H+G0bCb+MlyUyQJEJzz7kp1WIBHogZq1D9GVTzFFt9PxfqAKOFU50SAAAAAElFTkSuQmCC",
                blurWidth: 8,
                blurHeight: 8
            }
        }
    },
    e => {
        var s = s => e(e.s = s);
        e.O(0, [209, 206, 301, 188, 876, 159, 43, 466, 441, 517, 358], () => s(97430)), _N_E = e.O()
    }
]);