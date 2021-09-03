<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
        ! function(a) {
            "use strict";

            function b(b, c) {
                this.itemsArray = [], this.$element = a(b), this.$element.hide(), this.isSelect = "SELECT" === b.tagName,
                    this.multiple = this.isSelect && b.hasAttribute("multiple"), this.objectItems = c && c.itemValue, this
                    .placeholderText = b.hasAttribute("placeholder") ? this.$element.attr("placeholder") : "", this
                    .inputSize = Math.max(1, this.placeholderText.length), this.$container = a(
                        '<div class="bootstrap-tagsinput"></div>'), this.$input = a('<input type="text" placeholder="' +
                        this.placeholderText + '"/>').appendTo(this.$container), this.$element.before(this.$container), this
                    .build(c)
            }

            function c(a, b) {
                if ("function" != typeof a[b]) {
                    var c = a[b];
                    a[b] = function(a) {
                        return a[c]
                    }
                }
            }

            function d(a, b) {
                if ("function" != typeof a[b]) {
                    var c = a[b];
                    a[b] = function() {
                        return c
                    }
                }
            }

            function e(a) {
                return a ? i.text(a).html() : ""
            }

            function f(a) {
                var b = 0;
                if (document.selection) {
                    a.focus();
                    var c = document.selection.createRange();
                    c.moveStart("character", -a.value.length), b = c.text.length
                } else(a.selectionStart || "0" == a.selectionStart) && (b = a.selectionStart);
                return b
            }

            function g(b, c) {
                var d = !1;
                return a.each(c, function(a, c) {
                    if ("number" == typeof c && b.which === c) return d = !0, !1;
                    if (b.which === c.which) {
                        var e = !c.hasOwnProperty("altKey") || b.altKey === c.altKey,
                            f = !c.hasOwnProperty("shiftKey") || b.shiftKey === c.shiftKey,
                            g = !c.hasOwnProperty("ctrlKey") || b.ctrlKey === c.ctrlKey;
                        if (e && f && g) return d = !0, !1
                    }
                }), d
            }
            var h = {
                tagClass: function(a) {
                    return "label label-info"
                },
                itemValue: function(a) {
                    return a ? a.toString() : a
                },
                itemText: function(a) {
                    return this.itemValue(a)
                },
                itemTitle: function(a) {
                    return null
                },
                freeInput: !0,
                addOnBlur: !0,
                maxTags: void 0,
                maxChars: void 0,
                confirmKeys: [32, 44],
                delimiter: ",",
                delimiterRegex: null,
                cancelConfirmKeysOnEmpty: !0,
                onTagExists: function(a, b) {
                    b.hide().fadeIn()
                },
                trimValue: !1,
                allowDuplicates: !1
            };
            b.prototype = {
                constructor: b,
                add: function(b, c, d) {
                    var f = this;
                    if (!(f.options.maxTags && f.itemsArray.length >= f.options.maxTags) && (b === !1 || b)) {
                        if ("string" == typeof b && f.options.trimValue && (b = a.trim(b)), "object" == typeof b &&
                            !f.objectItems) throw "Can't add objects when itemValue option is not set";
                        if (!b.toString().match(/^\s*$/)) {
                            if (f.isSelect && !f.multiple && f.itemsArray.length > 0 && f.remove(f.itemsArray[0]),
                                "string" == typeof b && "INPUT" === this.$element[0].tagName) {
                                var g = f.options.delimiterRegex ? f.options.delimiterRegex : f.options.delimiter,
                                    h = b.split(g);
                                if (h.length > 1) {
                                    for (var i = 0; i < h.length; i++) this.add(h[i], !0);
                                    return void(c || f.pushVal())
                                }
                            }
                            var j = f.options.itemValue(b),
                                k = f.options.itemText(b),
                                l = f.options.tagClass(b),
                                m = f.options.itemTitle(b),
                                n = a.grep(f.itemsArray, function(a) {
                                    return f.options.itemValue(a) === j
                                })[0];
                            if (!n || f.options.allowDuplicates) {
                                if (!(f.items().toString().length + b.length + 1 > f.options.maxInputLength)) {
                                    var o = a.Event("beforeItemAdd", {
                                        item: b,
                                        cancel: !1,
                                        options: d
                                    });
                                    if (f.$element.trigger(o), !o.cancel) {
                                        f.itemsArray.push(b);
                                        var p = a('<span class="tag ' + e(l) + (null !== m ? '" title="' + m : "") +
                                            '">' + e(k) + '<span data-role="remove"></span></span>');
                                        if (p.data("item", b), f.findInputWrapper().before(p), p.after(" "), f
                                            .isSelect && !a('option[value="' + encodeURIComponent(j) + '"]', f
                                                .$element)[0]) {
                                            var q = a("<option selected>" + e(k) + "</option>");
                                            q.data("item", b), q.attr("value", j), f.$element.append(q)
                                        }
                                        c || f.pushVal(), (f.options.maxTags === f.itemsArray.length || f.items()
                                                .toString().length === f.options.maxInputLength) && f.$container
                                            .addClass("bootstrap-tagsinput-max"), f.$element.trigger(a.Event(
                                                "itemAdded", {
                                                    item: b,
                                                    options: d
                                                }))
                                    }
                                }
                            } else if (f.options.onTagExists) {
                                var r = a(".tag", f.$container).filter(function() {
                                    return a(this).data("item") === n
                                });
                                f.options.onTagExists(b, r)
                            }
                        }
                    }
                },
                remove: function(b, c, d) {
                    var e = this;
                    if (e.objectItems && (b = "object" == typeof b ? a.grep(e.itemsArray, function(a) {
                            return e.options.itemValue(a) == e.options.itemValue(b)
                        }) : a.grep(e.itemsArray, function(a) {
                            return e.options.itemValue(a) == b
                        }), b = b[b.length - 1]), b) {
                        var f = a.Event("beforeItemRemove", {
                            item: b,
                            cancel: !1,
                            options: d
                        });
                        if (e.$element.trigger(f), f.cancel) return;
                        a(".tag", e.$container).filter(function() {
                            return a(this).data("item") === b
                        }).remove(), a("option", e.$element).filter(function() {
                            return a(this).data("item") === b
                        }).remove(), -1 !== a.inArray(b, e.itemsArray) && e.itemsArray.splice(a.inArray(b, e
                            .itemsArray), 1)
                    }
                    c || e.pushVal(), e.options.maxTags > e.itemsArray.length && e.$container.removeClass(
                        "bootstrap-tagsinput-max"), e.$element.trigger(a.Event("itemRemoved", {
                        item: b,
                        options: d
                    }))
                },
                removeAll: function() {
                    var b = this;
                    for (a(".tag", b.$container).remove(), a("option", b.$element).remove(); b.itemsArray.length >
                        0;) b.itemsArray.pop();
                    b.pushVal()
                },
                refresh: function() {
                    var b = this;
                    a(".tag", b.$container).each(function() {
                        var c = a(this),
                            d = c.data("item"),
                            f = b.options.itemValue(d),
                            g = b.options.itemText(d),
                            h = b.options.tagClass(d);
                        if (c.attr("class", null), c.addClass("tag " + e(h)), c.contents().filter(
                        function() {
                                return 3 == this.nodeType
                            })[0].nodeValue = e(g), b.isSelect) {
                            var i = a("option", b.$element).filter(function() {
                                return a(this).data("item") === d
                            });
                            i.attr("value", f)
                        }
                    })
                },
                items: function() {
                    return this.itemsArray
                },
                pushVal: function() {
                    var b = this,
                        c = a.map(b.items(), function(a) {
                            return b.options.itemValue(a).toString()
                        });
                    b.$element.val(c, !0).trigger("change")
                },
                build: function(b) {
                    var e = this;
                    if (e.options = a.extend({}, h, b), e.objectItems && (e.options.freeInput = !1), c(e.options,
                            "itemValue"), c(e.options, "itemText"), d(e.options, "tagClass"), e.options.typeahead) {
                        var i = e.options.typeahead || {};
                        d(i, "source"), e.$input.typeahead(a.extend({}, i, {
                            source: function(b, c) {
                                function d(a) {
                                    for (var b = [], d = 0; d < a.length; d++) {
                                        var g = e.options.itemText(a[d]);
                                        f[g] = a[d], b.push(g)
                                    }
                                    c(b)
                                }
                                this.map = {};
                                var f = this.map,
                                    g = i.source(b);
                                a.isFunction(g.success) ? g.success(d) : a.isFunction(g.then) ? g
                                    .then(d) : a.when(g).then(d)
                            },
                            updater: function(a) {
                                return e.add(this.map[a]), this.map[a]
                            },
                            matcher: function(a) {
                                return -1 !== a.toLowerCase().indexOf(this.query.trim()
                                .toLowerCase())
                            },
                            sorter: function(a) {
                                return a.sort()
                            },
                            highlighter: function(a) {
                                var b = new RegExp("(" + this.query + ")", "gi");
                                return a.replace(b, "<strong>$1</strong>")
                            }
                        }))
                    }
                    if (e.options.typeaheadjs) {
                        var j = null,
                            k = {},
                            l = e.options.typeaheadjs;
                        a.isArray(l) ? (j = l[0], k = l[1]) : k = l, e.$input.typeahead(j, k).on(
                            "typeahead:selected", a.proxy(function(a, b) {
                                k.valueKey ? e.add(b[k.valueKey]) : e.add(b), e.$input.typeahead("val", "")
                            }, e))
                    }
                    e.$container.on("click", a.proxy(function(a) {
                        e.$element.attr("disabled") || e.$input.removeAttr("disabled"), e.$input.focus()
                    }, e)), e.options.addOnBlur && e.options.freeInput && e.$input.on("focusout", a.proxy(
                        function(b) {
                            0 === a(".typeahead, .twitter-typeahead", e.$container).length && (e.add(e
                                .$input.val()), e.$input.val(""))
                        }, e)), e.$container.on("keydown", "input", a.proxy(function(b) {
                        var c = a(b.target),
                            d = e.findInputWrapper();
                        if (e.$element.attr("disabled")) return void e.$input.attr("disabled",
                            "disabled");
                        switch (b.which) {
                            case 8:
                                if (0 === f(c[0])) {
                                    var g = d.prev();
                                    g.length && e.remove(g.data("item"))
                                }
                                break;
                            case 46:
                                if (0 === f(c[0])) {
                                    var h = d.next();
                                    h.length && e.remove(h.data("item"))
                                }
                                break;
                            case 37:
                                var i = d.prev();
                                0 === c.val().length && i[0] && (i.before(d), c.focus());
                                break;
                            case 39:
                                var j = d.next();
                                0 === c.val().length && j[0] && (j.after(d), c.focus())
                        }
                        var k = c.val().length;
                        Math.ceil(k / 5);
                        c.attr("size", Math.max(this.inputSize, c.val().length))
                    }, e)), e.$container.on("keypress", "input", a.proxy(function(b) {
                        var c = a(b.target);
                        if (e.$element.attr("disabled")) return void e.$input.attr("disabled",
                            "disabled");
                        var d = c.val(),
                            f = e.options.maxChars && d.length >= e.options.maxChars;
                        e.options.freeInput && (g(b, e.options.confirmKeys) || f) && (0 !== d.length &&
                            (e.add(f ? d.substr(0, e.options.maxChars) : d), c.val("")), e.options
                            .cancelConfirmKeysOnEmpty === !1 && b.preventDefault());
                        var h = c.val().length;
                        Math.ceil(h / 5);
                        c.attr("size", Math.max(this.inputSize, c.val().length))
                    }, e)), e.$container.on("click", "[data-role=remove]", a.proxy(function(b) {
                        e.$element.attr("disabled") || e.remove(a(b.target).closest(".tag").data(
                            "item"))
                    }, e)), e.options.itemValue === h.itemValue && ("INPUT" === e.$element[0].tagName ? e.add(e
                        .$element.val()) : a("option", e.$element).each(function() {
                        e.add(a(this).attr("value"), !0)
                    }))
                },
                destroy: function() {
                    var a = this;
                    a.$container.off("keypress", "input"), a.$container.off("click", "[role=remove]"), a.$container
                        .remove(), a.$element.removeData("tagsinput"), a.$element.show()
                },
                focus: function() {
                    this.$input.focus()
                },
                input: function() {
                    return this.$input
                },
                findInputWrapper: function() {
                    for (var b = this.$input[0], c = this.$container[0]; b && b.parentNode !== c;) b = b.parentNode;
                    return a(b)
                }
            }, a.fn.tagsinput = function(c, d, e) {
                var f = [];
                return this.each(function() {
                    var g = a(this).data("tagsinput");
                    if (g)
                        if (c || d) {
                            if (void 0 !== g[c]) {
                                if (3 === g[c].length && void 0 !== e) var h = g[c](d, null, e);
                                else var h = g[c](d);
                                void 0 !== h && f.push(h)
                            }
                        } else f.push(g);
                    else g = new b(this, c), a(this).data("tagsinput", g), f.push(g), "SELECT" === this
                        .tagName && a("option", a(this)).attr("selected", "selected"), a(this).val(a(this)
                        .val())
                }), "string" == typeof c ? f.length > 1 ? f : f[0] : f
            }, a.fn.tagsinput.Constructor = b;
            var i = a("<div />");
            a(function() {
                a("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput()
            })
        }(window.jQuery);
    </script>
    <style>
        .bootstrap-tagsinput {
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            display: inline-block;
            padding: 4px 6px;
            color: #555;
            vertical-align: middle;
            border-radius: 4px;
            max-width: 100%;
            line-height: 28px;
            cursor: text;
        }

        .bootstrap-tagsinput input {
            border: none;
            box-shadow: none;
            outline: none;
            background-color: transparent;
            padding: 0 6px;
            margin: 0;
            width: auto;
            max-width: inherit;
        }

        .bootstrap-tagsinput.form-control input::-moz-placeholder {
            color: #777;
            opacity: 1;
        }

        .bootstrap-tagsinput.form-control input:-ms-input-placeholder {
            color: #777;
        }

        .bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
            color: #777;
        }

        .bootstrap-tagsinput input:focus {
            border: none;
            box-shadow: none;
        }

        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white;
            background-color: #17a2b8;
        }

        .bootstrap-tagsinput .tag [data-role="remove"] {
            margin-left: 8px;
            cursor: pointer;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]:after {
            content: "x";
            padding: 0px 2px;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]:hover {
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        }

    </style>
    <style>
        #barra-rolagem {

            margin-top: 60px;
            background: #f5f5f5;
            display: block;
            overflow-y: auto;
            overflow-x: hidden;

        }

    </style>
</head>

<body class="bg-info " id="barra-rolagem">
    @if (session('msgDel'))
        <div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
            <p>{{ session('msgSuc') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('msgErro'))
        <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
            <p>{{ session('msgSuc') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('msgSuc'))
        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
            <p>{{ session('msgSuc') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script>
        $("#novoTel").click(function() {
            $("#eventoNovoTel").append(
                '<div class="col-lg-6 col-md-6 col-sm-6 mt-2 input-group form-group remove-dados"><div class="input-group-prepend"><button class="btn btn-danger remove" type="button">-</button></div><input type="text" class="form-control" required placeholder="Telefone" id="" name="telefone[]" /></div>'
            );
        });
        var cont = 1;
        $("#novoEnd").click(function() {
            cont++;
            $("#eventoNovoEnd").append(
                '<div class="remove-dados"><div class="row form-group"><div class="col-lg-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="CEP" name="cep[]" id="cep' +
                cont + '" onblur="getDadosEndPorCEP2(' + cont + ')" /></div>' +
                '<div class="col-lg-6 col-sm-6 mt-2"><input type="text" class="form-control" placeholder="Endereço"  name="endereco[]" id="endereco' +
                cont + '" /></div>' +
                '<div class="col-lg-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="Bairro" name="bairro[]" id="bairro' +
                cont + '" /></div></div>' +
                '<div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="Cidade" name="cidade[]" id="cidade' +
                cont + '" /></div>' +
                '<div class="col-lg-3 col-md-3 col-sm-3 mt-2"><input type="text" class="form-control" placeholder="UF" name="uf[]" id="uf' +
                cont + '" /></div>' +
                '<div class="col-lg-3 col-md-3 col-sm-3 mt-2"> <input type="text" class="form-control" placeholder="Número" name="numero[]" id="numero' +
                cont + '" /></div>' +
                '<div class="col-lg-3 col-md-3 col-sm-3 mt-2"><button class="btn btn-danger remove w-100" type="button">Remover</button></div></div><hr class="bg-secondary"></div>'
            );
        });
        //Remover campos de dados
        $(document).on('click', 'button.remove', function() {
            $(this).closest('div.remove-dados').remove();
        });
    </script>
    <script>
        function getDadosEndPorCEP() {
            let cep = document.getElementById('cep').value;
            let url = 'https://viacep.com.br/ws/' + cep + '/json/unicode/';
            console.log(url);
            let xmlHttp = new XMLHttpRequest();
            xmlHttp.open('GET', url)
            xmlHttp.onreadystatechange = () => {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    let dadosJsonText = xmlHttp.responseText;
                    let dadosJsonObj = JSON.parse(dadosJsonText);
                    document.getElementById('endereco').value = dadosJsonObj.logradouro;
                    document.getElementById('bairro').value = dadosJsonObj.bairro;
                    document.getElementById('cidade').value = dadosJsonObj.localidade;
                    document.getElementById('uf').value = dadosJsonObj.uf;
                }
            }
            xmlHttp.send()
        }

        function getDadosEndPorCEP2(int) {
            let cep = document.getElementById('cep' + int).value;
            let url = 'https://viacep.com.br/ws/' + cep + '/json/unicode/';
            console.log(url);
            let xmlHttp = new XMLHttpRequest();
            xmlHttp.open('GET', url)
            xmlHttp.onreadystatechange = () => {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    let dadosJsonText = xmlHttp.responseText;
                    let dadosJsonObj = JSON.parse(dadosJsonText);
                    document.getElementById('endereco' + int).value = dadosJsonObj.logradouro;
                    document.getElementById('bairro' + int).value = dadosJsonObj.bairro;
                    document.getElementById('cidade' + int).value = dadosJsonObj.localidade;
                    document.getElementById('uf' + int).value = dadosJsonObj.uf;
                }
            }
            xmlHttp.send()
        }
    </script>
</body>
</html>