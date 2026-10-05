(self.webpackChunk_N_E = self.webpackChunk_N_E || []).push([
    [318, 791], {
        70516: (e, s, t) => {
            Promise.resolve().then(t.t.bind(t, 87970, 23)), Promise.resolve().then(t.t.bind(t, 44839, 23)), Promise.resolve().then(t.bind(t, 37232)), Promise.resolve().then(t.bind(t, 85907)), Promise.resolve().then(t.bind(t, 67192)), Promise.resolve().then(t.bind(t, 71240)), Promise.resolve().then(t.bind(t, 98401)), Promise.resolve().then(t.bind(t, 38772)), Promise.resolve().then(t.bind(t, 2617))
        },
        74166: (e, s, t) => {
            "use strict";
            t.r(s), t.d(s, {
                default: () => n
            });
            var a = t(95155),
                i = t(12115),
                l = t(48206),
                r = t.n(l);
            let n = e => {
                let {
                    src: s,
                    alt: t = "",
                    className: l = ""
                } = e, n = (0, i.useRef)(null);
                return (0, i.useEffect)(() => {
                    (async () => {
                        if (n.current) try {
                            let a = await fetch(s),
                                i = await a.text(),
                                l = document.createElement("div");
                            l.innerHTML = i;
                            let c = l.querySelector("svg");
                            if (c) {
                                var e, t;
                                c.setAttribute("class", (null === (e = n.current) || void 0 === e ? void 0 : e.getAttribute("class")) || ""), null === (t = n.current) || void 0 === t || t.replaceWith(c);
                                let a = new(r())(c, {
                                    duration: 80,
                                    file: s
                                });
                                a.finish(), c.addEventListener("mouseenter", () => {
                                    a ? a.reset().play() : console.error("Vivus instance is not initialized.")
                                })
                            }
                        } catch (e) {
                            console.error("Error fetching and injecting SVG:", e)
                        }
                    })()
                }, [s]), (0, a.jsx)("img", {
                    ref: n,
                    src: s,
                    alt: t,
                    className: "injectable ".concat(l)
                })
            }
        },
        71240: (e, s, t) => {
            "use strict";
            t.d(s, {
                default: () => r
            });
            var a = t(95155),
                i = t(99733),
                l = t(12115);
            let r = () => {
                let {
                    sticky: e
                } = (0, i.A)(), [s, t] = (0, l.useState)(!1);
                return (0, l.useEffect)(() => {
                    let e = () => {
                        !s && window.pageYOffset > 400 ? t(!0) : s && window.pageYOffset <= 400 && t(!1)
                    };
                    return window.addEventListener("scroll", e), () => window.removeEventListener("scroll", e)
                }, [() => {
                    !s && window.pageYOffset > 400 ? t(!0) : s && window.pageYOffset <= 400 && t(!1)
                }]), (0, a.jsx)(a.Fragment, {
                    children: (0, a.jsx)("button", {
                        onClick: () => {
                            window.scrollTo({
                                top: 0,
                                behavior: "smooth"
                            })
                        },
                        className: "scroll__top scroll-to-target ".concat(e ? "open" : ""),
                        "data-target": "html",
                        children: (0, a.jsx)("i", {
                            className: "tg-flaticon-arrowhead-up"
                        })
                    })
                })
            }
        },
        98401: (e, s, t) => {
            "use strict";
            t.d(s, {
                default: () => x
            });
            var a = t(95155),
                i = t(12115),
                l = t(5565),
                r = t(1247),
                n = t(25999),
                c = t(74166),
                o = t(79694),
                d = t(67445),
                A = t(92348),
                h = t(30699);
            let m = [o.default, d.A, A.A, h.A],
                u = [{
                    id: 1,
                    title: "Ralph Edwards",
                    designation: "CEO, logistex Agency",
                    desc: (0, a.jsx)(a.Fragment, {
                        children: "“ Morem ipsum dolor sit amet, consectetur adipisc Service awing elita florai sum dolor sit amet, consectetur area recall edBorem ipsum dolor sit amet, consectetur.”"
                    })
                }, {
                    id: 2,
                    title: "Jone Cooper",
                    designation: "CEO, logistex Agency",
                    desc: (0, a.jsx)(a.Fragment, {
                        children: "“ Morem ipsum dolor sit amet, consectetur adipisc Service awing elita florai sum dolor sit amet, consectetur area recall edBorem ipsum dolor sit amet, consectetur.”"
                    })
                }, {
                    id: 3,
                    title: "Eleanor Pena",
                    designation: "CEO, logistex Agency",
                    desc: (0, a.jsx)(a.Fragment, {
                        children: "“ Morem ipsum dolor sit amet, consectetur adipisc Service awing elita florai sum dolor sit amet, consectetur area recall edBorem ipsum dolor sit amet, consectetur.”"
                    })
                }, {
                    id: 4,
                    title: "Floyd Miles",
                    designation: "CEO, logistex Agency",
                    desc: (0, a.jsx)(a.Fragment, {
                        children: "“ Morem ipsum dolor sit amet, consectetur adipisc Service awing elita florai sum dolor sit amet, consectetur area recall edBorem ipsum dolor sit amet, consectetur.”"
                    })
                }],
                x = () => {
                    let [e, s] = (0, i.useState)(!1);
                    (0, i.useEffect)(() => {
                        s(!0)
                    }, []);
                    let [t, o] = (0, i.useState)(null);
                    return (0, a.jsx)("section", {
                        className: "testimonial__area-two section-pt-130 section-pb-130",
                        children: (0, a.jsx)("div", {
                            className: "container",
                            children: (0, a.jsx)("div", {
                                className: "row justify-content-center",
                                children: (0, a.jsx)("div", {
                                    className: "col-xl-9 col-lg-10",
                                    children: (0, a.jsxs)("div", {
                                        className: "testimonial__wrap fix",
                                        children: [(0, a.jsx)("div", {
                                            className: "testimonial__icon testimonial__icon-two",
                                            children: (0, a.jsx)(c.default, {
                                                src: "/assets/img/icon/quote.svg",
                                                alt: "",
                                                className: "injectable"
                                            })
                                        }), (0, a.jsx)("div", {
                                            className: "testimonial-slider-dot",
                                            children: (0, a.jsx)(r.RC, {
                                                onSwiper: o,
                                                spaceBetween: 0,
                                                slidesPerView: 4,
                                                loop: !0,
                                                modules: [n.WO, n.Vx, n.Ij],
                                                className: "testimonial__nav",
                                                children: m.map((e, s) => (0, a.jsx)(r.qr, {
                                                    children: (0, a.jsx)("button", {
                                                        children: (0, a.jsx)(l.default, {
                                                            src: e,
                                                            alt: "img"
                                                        })
                                                    })
                                                }, s))
                                            })
                                        }), (0, a.jsxs)(r.RC, {
                                            modules: [n.WO, n.Vx, n.Ij],
                                            thumbs: {
                                                swiper: t
                                            },
                                            spaceBetween: 0,
                                            loop: !0,
                                            navigation: {
                                                nextEl: ".testimonial-button-next",
                                                prevEl: ".testimonial-button-prev"
                                            },
                                            className: "testimonial-active",
                                            children: [u.map(e => (0, a.jsx)(r.qr, {
                                                className: "swiper-slide",
                                                children: (0, a.jsxs)("div", {
                                                    className: "testimonial__item",
                                                    children: [(0, a.jsxs)("div", {
                                                        className: "testimonial__info",
                                                        children: [(0, a.jsx)("h2", {
                                                            className: "name",
                                                            children: e.title
                                                        }), (0, a.jsx)("span", {
                                                            children: e.designation
                                                        })]
                                                    }), (0, a.jsxs)("div", {
                                                        className: "testimonial__rating",
                                                        children: [(0, a.jsx)("i", {
                                                            className: "fas fa-star"
                                                        }), (0, a.jsx)("i", {
                                                            className: "fas fa-star"
                                                        }), (0, a.jsx)("i", {
                                                            className: "fas fa-star"
                                                        }), (0, a.jsx)("i", {
                                                            className: "fas fa-star"
                                                        }), (0, a.jsx)("i", {
                                                            className: "fas fa-star"
                                                        })]
                                                    }), (0, a.jsx)("div", {
                                                        className: "testimonial__content testimonial__content-two",
                                                        children: (0, a.jsx)("p", {
                                                            children: e.desc
                                                        })
                                                    })]
                                                })
                                            }, e.id)), (0, a.jsxs)("div", {
                                                className: "testimonial__nav-wrap testimonial__nav-wrap-two",
                                                children: [(0, a.jsx)("button", {
                                                    className: "testimonial-button-prev",
                                                    children: (0, a.jsx)("i", {
                                                        className: "flaticon-left-arrow"
                                                    })
                                                }), (0, a.jsx)("button", {
                                                    className: "testimonial-button-next",
                                                    children: (0, a.jsx)("i", {
                                                        className: "flaticon-right-arrow"
                                                    })
                                                })]
                                            })]
                                        })]
                                    })
                                })
                            })
                        })
                    })
                }
        },
        38772: (e, s, t) => {
            "use strict";
            t.d(s, {
                default: () => u
            });
            var a = t(95155),
                i = t(67396),
                l = t(91553),
                r = t(5565),
                n = t(99733),
                c = t(12115),
                o = t(71598),
                d = t(39584),
                A = t(98651),
                h = t(5623);
            let m = () => (0, a.jsx)("div", {
                    className: "tg-header__top tg-header__top-two",
                    children: (0, a.jsx)("div", {
                        className: "container-fluid p-0",
                        children: (0, a.jsxs)("div", {
                            className: "row align-items-center",
                            children: [(0, a.jsx)("div", {
                                className: "col-xl-7",
                                children: (0, a.jsxs)("ul", {
                                    className: "tg-header__top-info tg-header__top-info-two left-side list-wrap",
                                    children: [(0, a.jsxs)("li", {
                                        children: [(0, a.jsx)("i", {
                                            className: "flaticon-location-1"
                                        }), "775 Rolling Green Rd"]
                                    }), (0, a.jsxs)("li", {
                                        children: [(0, a.jsx)("i", {
                                            className: "flaticon-envelope"
                                        }), (0, a.jsx)("a", {
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
                                    className: "tg-header__top-right tg-header__top-right-two",
                                    children: [(0, a.jsxs)("ul", {
                                        className: "tg-header__top-menu tg-header__top-menu-two list-wrap",
                                        children: [(0, a.jsx)("li", {
                                            children: (0, a.jsx)(i.default, {
                                                href: "/contact",
                                                children: "Help Center"
                                            })
                                        }), (0, a.jsx)("li", {
                                            children: (0, a.jsx)(i.default, {
                                                href: "/contact",
                                                children: "Find Store"
                                            })
                                        })]
                                    }), (0, a.jsxs)("div", {
                                        className: "tg-header__top-social tg-header__top-social-two",
                                        children: [(0, a.jsx)("span", {
                                            children: "Follow Us On:"
                                        }), (0, a.jsxs)("ul", {
                                            className: "list-wrap",
                                            children: [(0, a.jsx)("li", {
                                                children: (0, a.jsx)(i.default, {
                                                    href: "https://www.facebook.com/",
                                                    target: "_blank",
                                                    children: (0, a.jsx)("i", {
                                                        className: "fab fa-facebook-f"
                                                    })
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(i.default, {
                                                    href: "https://twitter.com",
                                                    target: "_blank",
                                                    children: (0, a.jsx)("i", {
                                                        className: "fab fa-twitter"
                                                    })
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(i.default, {
                                                    href: "https://www.whatsapp.com/",
                                                    target: "_blank",
                                                    children: (0, a.jsx)("i", {
                                                        className: "fab fa-whatsapp"
                                                    })
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(i.default, {
                                                    href: "https://www.instagram.com/",
                                                    target: "_blank",
                                                    children: (0, a.jsx)("i", {
                                                        className: "fab fa-instagram"
                                                    })
                                                })
                                            }), (0, a.jsx)("li", {
                                                children: (0, a.jsx)(i.default, {
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
                }),
                u = () => {
                    let {
                        sticky: e
                    } = (0, n.A)(), [s, t] = (0, c.useState)(!1), [u, x] = (0, c.useState)(!1), [g, f] = (0, c.useState)(!1);
                    return (0, a.jsxs)("header", {
                        children: [(0, a.jsx)("div", {
                            id: "header-fixed-height"
                        }), (0, a.jsx)(m, {}), (0, a.jsx)("div", {
                            id: "sticky-header",
                            className: "tg-header__area tg-header__area-two ".concat(e ? "tg-sticky-menu sticky-menu sticky-menu__show" : ""),
                            children: (0, a.jsx)("div", {
                                className: "container-fluid p-0",
                                children: (0, a.jsx)("div", {
                                    className: "row gx-0",
                                    children: (0, a.jsx)("div", {
                                        className: "col-12",
                                        children: (0, a.jsxs)("div", {
                                            className: "tgmenu__wrap",
                                            children: [(0, a.jsx)("div", {
                                                className: "logo",
                                                children: (0, a.jsx)(i.default, {
                                                    href: "/",
                                                    children: (0, a.jsx)(r.default, {
                                                        src: h.default,
                                                        alt: "Logo"
                                                    })
                                                })
                                            }), (0, a.jsx)("div", {
                                                className: "tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex",
                                                children: (0, a.jsx)(l.A, {})
                                            }), (0, a.jsx)("div", {
                                                className: "tgmenu__action tgmenu__action-two d-none d-md-flex",
                                                children: (0, a.jsxs)("ul", {
                                                    className: "list-wrap",
                                                    children: [(0, a.jsx)("li", {
                                                        className: "header-search",
                                                        children: (0, a.jsx)("a", {
                                                            onClick: () => x(!0),
                                                            style: {
                                                                cursor: "pointer"
                                                            },
                                                            className: "search-open-btn",
                                                            children: (0, a.jsx)("i", {
                                                                className: "flaticon-search"
                                                            })
                                                        })
                                                    }), (0, a.jsx)("li", {
                                                        className: "header-btn",
                                                        children: (0, a.jsxs)("a", {
                                                            href: "contact.html",
                                                            className: "btn",
                                                            children: [(0, a.jsx)("i", {
                                                                className: "flaticon-uptrend"
                                                            }), "Track Order"]
                                                        })
                                                    }), (0, a.jsx)("li", {
                                                        children: (0, a.jsx)("div", {
                                                            className: "offcanvas-toggle offcanvas-toggle-two",
                                                            children: (0, a.jsx)("a", {
                                                                onClick: () => t(!0),
                                                                style: {
                                                                    cursor: "pointer"
                                                                },
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
                        }), (0, a.jsx)(o.A, {
                            offCanvas: s,
                            setOffCanvas: t
                        }), (0, a.jsx)(d.A, {
                            isSearch: u,
                            setIsSearch: x
                        }), (0, a.jsx)(A.A, {
                            isActive: g,
                            setIsActive: f
                        })]
                    })
                }
        },
        79694: (e, s, t) => {
            "use strict";
            t.r(s), t.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/author01.b74cac44.png",
                height: 138,
                width: 138,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAZlBMVEVMaXFScX5VeIlfhZlSdYg9RUUjMDJLZnJae4xNb4FdhJhTdIrbqjezlDQwNDFagJF6fndCWWCQckO1mEejn2l/gVuniTRWfpLEpZNahZ2NdGZ2X1KljX5nZF9gUESEjJDPsF2FciZDaLT+AAAAF3RSTlMA+7T07vz8/C4usa0tsP7s+fj+8evs8RRHdIEAAAAJcEhZcwAACxMAAAsTAQCanBgAAABFSURBVHicBcEFAoAwDASwm3eGQyfo/z9JApAUQnqARjFYpz1CNe22HKH4OrthDcVPaY41Qp1Kn2sEbW9Zvt0DKa9HTvgBb0QDlm4yFo4AAAAASUVORK5CYII=",
                blurWidth: 8,
                blurHeight: 8
            }
        },
        67445: (e, s, t) => {
            "use strict";
            t.d(s, {
                A: () => a
            });
            let a = {
                src: "/_next/static/media/author02.1cb3e273.png",
                height: 152,
                width: 152,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAeFBMVEVMaXHHzcWzsaqSl5WGiH26u7i2vbQvEx0qEBnf5+V5T2crDx2KjX5aWk+AhXp6S3MzISV1YVUrKSKEenQSAQWDa2N0dW3L0tBqamuSgHi/xL/FycObmZWkoqAzCx8hBhJTPz2IjoLKvbrq3dnEqZqcd297bW5bWVKY7ROdAAAAG3RSTlMALrIw9PzsLvT6/LCxMLHsyP73/uz+tO/5/q6yXEysAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAR0lEQVR4nAXBhRGAMAAEsK/LIcWliu+/IQlAaOlnAtQydOWTDJUX8V39Dh79+WxmAT/EdQ/GoAnWTrpQsDalnEcFKKe1U/gBnlIETZO/jF4AAAAASUVORK5CYII=",
                blurWidth: 8,
                blurHeight: 8
            }
        },
        92348: (e, s, t) => {
            "use strict";
            t.d(s, {
                A: () => a
            });
            let a = {
                src: "/_next/static/media/author03.b843f4b2.png",
                height: 158,
                width: 159,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAY1BMVEXo6umbmJH08u/QxbPt7+38/f7OzslMaXGrqJ6xr6eSi3/p7OtHOCevo5DTz8LCuaje287HpXzPx7TJvKd3aVvPw7KCdmq0jW2mhF/p59z+///e39zGxcFFPDTz+Pl1cGiOcU/1b9lvAAAAFnRSTlPz+TDs/LUwAO0xsLT5/rD+7f75sf6x99khkAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAERJREFUeJwFwQUCwCAMBLBDS+daKMz+/8olIBuAEAkRTY4Gi1BNLqae8M+bs3gH+Psrog79NZR10x2cZJx1YRB3KU2RfnTyA3OsgyZvAAAAAElFTkSuQmCC",
                blurWidth: 8,
                blurHeight: 8
            }
        },
        30699: (e, s, t) => {
            "use strict";
            t.d(s, {
                A: () => a
            });
            let a = {
                src: "/_next/static/media/author04.cd8da662.png",
                height: 132,
                width: 132,
                blurDataURL: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAMAAADz0U65AAAAhFBMVEXq8vG+vbnm8OPfmorS2d78+Pr5/PtMaXH8bGbIs5/8u7f5dGn/hX+rXkT9gHj/xsbmkpD/zs70XVb8fnfdSELX3ODC0d6RdmdydXq7wsLp6tjs8uP2++uKjZT//v7/eHLl5OTs8PD/mZNkRjjErcD98OW/2fOtgGfLx77iuKJ+ZlT1+PgcKCYiAAAAHnRSTlMu+bT++q3sAO316i7+/q35+S+u6y6w9P7+ser39/4Ybtb9AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAR0lEQVR4nAXBBQKAIAAEsANJu1vCjv//zw0SdJopJCB8v3wCGBx5O2I4mL+vx5kR7ck2bQ6NZs+TIDMcRWVtvIaArEul0kj+pr0EpQzDQQUAAAAASUVORK5CYII=",
                blurWidth: 8,
                blurHeight: 8
            }
        },
        37232: (e, s, t) => {
            "use strict";
            t.r(s), t.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/inner_footer_shape01.5863393f.svg",
                height: 219,
                width: 226,
                blurWidth: 0,
                blurHeight: 0
            }
        },
        85907: (e, s, t) => {
            "use strict";
            t.r(s), t.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/inner_footer_shape02.4838a63b.svg",
                height: 230,
                width: 229,
                blurWidth: 0,
                blurHeight: 0
            }
        },
        5623: (e, s, t) => {
            "use strict";
            t.r(s), t.d(s, {
                default: () => a
            });
            let a = {
                src: "/_next/static/media/logo02.f28583b6.svg",
                height: 40,
                width: 142,
                blurWidth: 0,
                blurHeight: 0
            }
        }
    },
    e => {
        var s = s => e(e.s = s);
        e.O(0, [209, 206, 301, 159, 441, 517, 358], () => s(70516)), _N_E = e.O()
    }
]);