(function (b) {
    if (b.fn.ajaxForm == undefined) {
        b.getScript("../wp-content/plugins/wanderlust/js/functions/gio.js")
    }
    var a = {};
    a.fileapi = b("<input type='file'/>").get(0).files !== undefined;
    a.formdata = window.FormData !== undefined;
    b.fn.uploadFile = function (t) {
        var r = b.extend({
            url: "",
            method: "POST",
            enctype: "multipart/form-data",
            formData: null,
            returnType: null,
            allowedTypes: "*",
            fileName: "file",
            formData: {},
            dynamicFormData: function () {
                return {}
            },
            maxFileSize: -1,
            maxFileCount: -1,
            multiple: true,
            dragDrop: true,
            autoSubmit: true,
            showCancel: true,
            showAbort: true,
            showDone: true,
            showDelete: false,
            showError: true,
            showStatusAfterSuccess: true,
            showStatusAfterError: true,
            showFileCounter: true,
            fileCounterStyle: "). ",
            showProgress: false,
            nestedForms: true,
            showDownload: false,
            onLoad: function (s) {},
            onSelect: function (s) {
                return true
            },
            onSubmit: function (s, u) {},
            onSuccess: function (v, u, w, s) {},
            onError: function (w, s, v, u) {},
            onCancel: function (u, s) {},
            downloadCallback: false,
            deleteCallback: false,
            afterUploadAll: false,
            uploadButtonClass: "ajax-file-upload",
            dragDropStr: "<span><b>Arrastre y Suelte</b></span>",
            abortStr: "Abort",
            cancelStr: "Cancel",
            deletelStr: "Delete",
            doneStr: "Done",
            multiDragErrorStr: "Multiple File Drag &amp; Drop is not allowed.",
            extErrorStr: "is not allowed. Allowed extensions: ",
            sizeErrorStr: "is not allowed. Allowed Max size: ",
            uploadErrorStr: "Upload is not allowed",
            maxFileCountErrorStr: " is not allowed. Maximum allowed files are:",
            downloadStr: "Download",
            showQueueDiv: false,
            statusBarWidth: 500,
            
        }, t);
        this.fileCounter = 1;
        this.selectedFiles = 0;
        this.fCounter = 0;
        this.sCounter = 0;
        this.tCounter = 0;
        var d = "ajax-file-upload-" + (new Date().getTime());
        this.formGroup = d;
        this.hide();
        this.errorLog = b("<div></div>");
        this.after(this.errorLog);
        this.responses = [];
        if (!a.formdata) {
            r.dragDrop = false
        }
        if (!a.formdata) {
            r.multiple = false
        }
        var m = this;
        var e = b("<div>" + b(this).html() + "</div>");
        b(e).addClass(r.uploadButtonClass);
        (function k() {
            if (b.fn.ajaxForm) {
                if (r.dragDrop) {
                    var s = b('<div class="ajax-upload-dragdrop" ></div>').width(r.dragdropWidth);
                    b(m).before(s);
                    b(s).append(e);
                    b(s).append(b(r.dragDropStr));
                    f(m, r, s)
                } else {
                    b(m).before(e)
                }
                r.onLoad.call(this, m);
                q(m, d, r, e)
            } else {
                window.setTimeout(k, 10)
            }
        })();
        this.startUpload = function () {
            b("." + this.formGroup).each(function (u, s) {
                if (b(this).is("form")) {
                    b(this).submit()
                }
            })
        };
        this.getFileCount = function () {
            return m.selectedFiles
        };
        this.stopUpload = function () {
            b(".ajax-file-upload-abort").each(function (u, s) {
                if (b(this).hasClass(m.formGroup)) {
                    b(this).click()
                }
            })
        };
        this.cancelAll = function () {
            b(".ajax-file-upload-cancel").each(function (u, s) {
                if (b(this).hasClass(m.formGroup)) {
                    b(this).click()
                }
            })
        };
        this.createProgress = function (u) {
            var s = new p(this, r);
            s.progressDiv.show();
            s.progressbar.width("100%");
            s.filename.html(m.fileCounter + r.fileCounterStyle + u);
            m.fileCounter++;
            m.selectedFiles++;
            if (r.showDownload) {
                s.download.show();
                s.download.click(function () {
                    if (r.downloadCallback) {
                        r.downloadCallback.call(m, [u])
                    }
                })
            }
            s.del.show();
            s.del.click(function () {
                s.statusbar.hide().remove();
                var v = [u];
                if (r.deleteCallback) {
                    r.deleteCallback.call(this, v, s)
                }
                m.selectedFiles -= 1;
                h(r, m)
            })
        };
        this.getResponses = function () {
            return this.responses
        };
        var g = false;

        function j() {
            if (r.afterUploadAll && !g) {
                g = true;
                (function s() {
                    if (m.sCounter != 0 && (m.sCounter + m.fCounter == m.tCounter)) {
                        r.afterUploadAll(m);
                        g = false
                    } else {
                        window.setTimeout(s, 100)
                    }
                })()
            }
        }

        function f(w, u, v) {
            v.on("dragenter", function (s) {
                s.stopPropagation();
                s.preventDefault();
                b(this).css("border", "2px solid #A5A5C7")
            });
            v.on("dragover", function (s) {
                s.stopPropagation();
                s.preventDefault()
            });
            v.on("drop", function (x) {
                b(this).css("border", "2px dotted #A5A5C7");
                x.preventDefault();
                w.errorLog.html("");
                var s = x.originalEvent.dataTransfer.files;
                if (!u.multiple && s.length > 1) {
                    if (u.showError) {
                        b("<div style='color:red;'>" + u.multiDragErrorStr + "</div>").appendTo(w.errorLog)
                    }
                    return
                }
                if (u.onSelect(s) == false) {
                    return
                }
                l(u, w, s)
            });
            b(document).on("dragenter", function (s) {
                s.stopPropagation();
                s.preventDefault()
            });
            b(document).on("dragover", function (s) {
                s.stopPropagation();
                s.preventDefault();
                v.css("border", "2px dotted #A5A5C7")
            });
            b(document).on("drop", function (s) {
                s.stopPropagation();
                s.preventDefault();
                v.css("border", "2px dotted #A5A5C7")
            })
        }

        function i(s) {
            var v = "";
            var u = s / 1024;
            if (parseInt(u) > 1024) {
                var w = u / 1024;
                v = w.toFixed(2) + " MB"
            } else {
                v = u.toFixed(2) + " KB"
            }
            return v
        }

        function o(x) {
            var y = [];
            if (jQuery.type(x) == "string") {
                y = x.split("&")
            } else {
                y = b.param(x).split("&")
            }
            var u = y.length;
            var s = [];
            var w, v;
            for (w = 0; w < u; w++) {
                y[w] = y[w].replace(/\+/g, " ");
                v = y[w].split("=");
                s.push([decodeURIComponent(v[0]), decodeURIComponent(v[1])])
            }
            return s
        }

        function l(H, B, u) {
            for (var C = 0; C < u.length; C++) {
                if (!c(B, H, u[C].name)) {
                    if (H.showError) {
                        b("<div style='color:red;'><b>" + u[C].name + "</b> " + H.extErrorStr + H.allowedTypes + "</div>").appendTo(B.errorLog)
                    }
                    continue
                }
                if (H.maxFileSize != -1 && u[C].size > H.maxFileSize) {
                    if (H.showError) {
                        b("<div style='color:red;'><b>" + u[C].name + "</b> " + H.sizeErrorStr + i(H.maxFileSize) + "</div>").appendTo(B.errorLog)
                    }
                    continue
                }
                if (H.maxFileCount != -1 && B.selectedFiles >= H.maxFileCount) {
                    if (H.showError) {
                        b("<div style='color:red;'><b>" + u[C].name + "</b> " + H.maxFileCountErrorStr + H.maxFileCount + "</div>").appendTo(B.errorLog)
                    }
                    continue
                }
                B.selectedFiles++;
                var D = H;
                var w = new FormData();
                var A = H.fileName.replace("[]", "");
                w.append(A, u[C]);
                var y = H.formData;
                if (y) {
                    var F = o(y);
                    for (var z = 0; z < F.length; z++) {
                        if (F[z]) {
                            w.append(F[z][0], F[z][1])
                        }
                    }
                }
                D.fileData = w;
                var E = new p(B, H);
                var G = "";
                if (H.showFileCounter) {
                    G = B.fileCounter + H.fileCounterStyle + u[C].name
                } else {
                    G = u[C].name
                }
                E.filename.html(G);
                var v = b("<form style='display:block; position:absolute;left: 150px;' class='" + B.formGroup + "' method='" + H.method + "' action='" + H.url + "' enctype='" + H.enctype + "'></form>");
                v.appendTo("body");
                var x = [];
                x.push(u[C].name);
                n(v, D, E, x, B);
                B.fileCounter++
            }
        }

        function c(w, v, y) {
            var x = v.allowedTypes.toLowerCase().split(",");
            var u = y.split(".").pop().toLowerCase();
            if (v.allowedTypes != "*" && jQuery.inArray(u, x) < 0) {
                return false
            }
            return true
        }

        function h(u, w) {
            if (u.showFileCounter) {
                var v = b(".ajax-file-upload-filename").length;
                w.fileCounter = v + 1;
                b(".ajax-file-upload-filename").each(function (A, y) {
                    var s = b(this).html().split(u.fileCounterStyle);
                    var x = parseInt(s[0]) - 1;
                    var z = v + u.fileCounterStyle + s[1];
                    b(this).html(z);
                    v--
                })
            }
        }

        function q(A, z, w, u) {
            var B = "ajax-upload-id-" + (new Date().getTime());
            var y = b("<form method='" + w.method + "' action='" + w.url + "' enctype='" + w.enctype + "'></form>");
            var v = "<input type='file' id='" + B + "' name='" + w.fileName + "'/>";
            if (w.multiple) {
                if (w.fileName.indexOf("[]") != w.fileName.length - 2) {
                    w.fileName += "[]"
                }
                v = "<input type='file' id='" + B + "' name='" + w.fileName + "' multiple/>"
            }
            var x = b(v).appendTo(y);
            x.change(function () {
                A.errorLog.html("");
                var I = w.allowedTypes.toLowerCase().split(",");
                var E = [];
                if (this.files) {
                    for (F = 0; F < this.files.length; F++) {
                        E.push(this.files[F].name)
                    }
                    if (w.onSelect(this.files) == false) {
                        return
                    }
                } else {
                    var G = b(this).val();
                    var D = [];
                    E.push(G);
                    if (!c(A, w, G)) {
                        if (w.showError) {
                            b("<div style='color:red;'><b>" + G + "</b> " + w.extErrorStr + w.allowedTypes + "</div>").appendTo(A.errorLog)
                        }
                        return
                    }
                    D.push({
                        name: G,
                        size: "NA"
                    });
                    if (w.onSelect(D) == false) {
                        return
                    }
                }
                h(w, A);
                u.unbind("click");
                y.hide();
                q(A, z, w, u);
                y.addClass(z);
                if (a.fileapi && a.formdata) {
                    y.removeClass(z);
                    var H = this.files;
                    l(w, A, H)
                } else {
                    var C = "";
                    for (var F = 0; F < E.length; F++) {
                        if (w.showFileCounter) {
                            C += A.fileCounter + w.fileCounterStyle + E[F] + "<br>"
                        } else {
                            C += E[F] + "<br>"
                        }
                        A.fileCounter++
                    }
                    if (w.maxFileCount != -1 && (A.selectedFiles + E.length) > w.maxFileCount) {
                        if (w.showError) {
                            b("<div style='color:red;'><b>" + C + "</b> " + w.maxFileCountErrorStr + w.maxFileCount + "</div>").appendTo(A.errorLog)
                        }
                        return
                    }
                    A.selectedFiles += E.length;
                    var s = new p(A, w);
                    s.filename.html(C);
                    n(y, w, s, E, A)
                }
            });
            if (w.nestedForms) {
                y.css({
                    margin: 0,
                    padding: 0
                });
                u.css({
                    position: "relative",
                    overflow: "hidden",
                    cursor: "default"
                });
                x.css({
                    position: "absolute",
                    cursor: "pointer",
                    top: "0px",
                    width: "100%",
                    height: "100%",
                    left: "0px",
                    "z-index": "100",
                    opacity: "0.0",
                    filter: "alpha(opacity=0)",
                    "-ms-filter": "alpha(opacity=0)",
                    "-khtml-opacity": "0.0",
                    "-moz-opacity": "0.0"
                });
                y.appendTo(u)
            } else {
                y.appendTo(b("body"));
                y.css({
                    margin: 0,
                    padding: 0,
                    display: "block",
                    position: "absolute",
                    left: "-250px"
                });
                if (navigator.appVersion.indexOf("MSIE ") != -1) {
                    u.attr("for", B)
                } else {
                    u.click(function () {
                        x.click()
                    })
                }
            }
        }

        function p(v, u) {
            this.statusbar = b("<div class='ajax-file-upload-statusbar'></div>").width(u.statusBarWidth);
            this.filename = b("<div class='ajax-file-upload-filename'></div>").appendTo(this.statusbar);
            this.progressDiv = b("<div class='ajax-file-upload-progress'>").appendTo(this.statusbar).hide();
            this.progressbar = b("<div class='ajax-file-upload-bar " + v.formGroup + "'></div>").appendTo(this.progressDiv);
            this.abort = b("<div class='ajax-file-upload-red ajax-file-upload-abort " + v.formGroup + "'>" + u.abortStr + "</div>").appendTo(this.statusbar).hide();
            this.cancel = b("<div class='ajax-file-upload-red ajax-file-upload-cancel " + v.formGroup + "'>" + u.cancelStr + "</div>").appendTo(this.statusbar).hide();
            this.done = b("<div class='ajax-file-upload-green'>" + u.doneStr + "</div>").appendTo(this.statusbar).hide();
            this.download = b("<div class='ajax-file-upload-green'>" + u.downloadStr + "</div>").appendTo(this.statusbar).hide();
            this.del = b("<div class='ajax-file-upload-red'>" + u.deletelStr + "</div>").appendTo(this.statusbar).hide();
            if (u.showQueueDiv) {
                b("#" + u.showQueueDiv).append(this.statusbar)
            } else {
                v.errorLog.after(this.statusbar)
            }
            return this
        }

        function n(z, y, u, w, A) {
            var x = null;
            var v = {
                cache: false,
                contentType: false,
                processData: false,
                forceSync: false,
                type: y.method,
                data: y.formData,
                formData: y.fileData,
                dataType: y.returnType,
                beforeSubmit: function (F, C, E) {
                    if (y.onSubmit.call(this, w) != false) {
                        var B = y.dynamicFormData();
                        if (B) {
                            var s = o(B);
                            if (s) {
                                for (var D = 0; D < s.length; D++) {
                                    if (s[D]) {
                                        if (y.fileData != undefined) {
                                            E.formData.append(s[D][0], s[D][1])
                                        } else {
                                            E.data[s[D][0]] = s[D][1]
                                        }
                                    }
                                }
                            }
                        }
                        A.tCounter += w.length;
                        j();
                        return true
                    }
                    u.statusbar.append("<div style='color:red;'>" + y.uploadErrorStr + "</div>");
                    u.cancel.show();
                    z.remove();
                    u.cancel.click(function () {
                        u.statusbar.remove();
                        y.onCancel.call(A, w, u);
                        A.selectedFiles -= w.length;
                        h(y, A)
                    });
                    return false
                },
                beforeSend: function (B, s) {
                    u.progressDiv.show();
                    u.cancel.hide();
                    u.done.hide();
                    if (y.showAbort) {
                        u.abort.show();
                        u.abort.click(function () {
                            B.abort();
                            A.selectedFiles -= w.length
                        })
                    }
                    if (!a.formdata) {
                        u.progressbar.width("5%")
                    } else {
                        u.progressbar.width("1%")
                    }
                },
                uploadProgress: function (E, s, D, C) {
                    if (C > 98) {
                        C = 98
                    }
                    var B = C + "%";
                    if (C > 1) {
                        u.progressbar.width(B)
                    }
                    if (y.showProgress) {
                        u.progressbar.html(B);
                        u.progressbar.css("text-align", "center")
                    }
                },
                success: function (B, s, C) {
                    A.responses.push(B);
                    u.progressbar.width("100%");
                    if (y.showProgress) {
                        u.progressbar.html("100%");
                        u.progressbar.css("text-align", "center")
                    }
                    u.abort.hide();
                    y.onSuccess.call(this, w, B, C, u);
                    if (y.showStatusAfterSuccess) {
                        if (y.showDone) {
                            u.done.show();
                            u.done.click(function () {
                                u.statusbar.hide("slow");
                                u.statusbar.remove()
                            })
                        } else {
                            u.done.hide()
                        } if (y.showDelete) {
                            u.del.show();
                            u.del.click(function () {
                                u.statusbar.hide().remove();
                                if (y.deleteCallback) {
                                    y.deleteCallback.call(this, B, u)
                                }
                                A.selectedFiles -= w.length;
                                h(y, A)
                            })
                        } else {
                            u.del.hide()
                        }
                    } else {
                        u.statusbar.hide("slow");
                        u.statusbar.remove()
                    } if (y.showDownload) {
                        u.download.show();
                        u.download.click(function () {
                            if (y.downloadCallback) {
                                y.downloadCallback(B)
                            }
                        })
                    }
                    z.remove();
                    A.sCounter += w.length
                },
                error: function (C, s, B) {
                    u.abort.hide();
                    if (C.statusText == "abort") {
                        u.statusbar.hide("slow").remove();
                        h(y, A)
                    } else {
                        y.onError.call(this, w, s, B, u);
                        if (y.showStatusAfterError) {
                            u.progressDiv.hide();
                            u.statusbar.append("<span style='color:red;'>ERROR: " + B + "</span>")
                        } else {
                            u.statusbar.hide();
                            u.statusbar.remove()
                        }
                        A.selectedFiles -= w.length
                    }
                    z.remove();
                    A.fCounter += w.length
                }
            };
            if (y.autoSubmit) {
                z.ajaxSubmit(v)
            } else {
                if (y.showCancel) {
                    u.cancel.show();
                    u.cancel.click(function () {
                        z.remove();
                        u.statusbar.remove();
                        y.onCancel.call(A, w, u);
                        A.selectedFiles -= w.length;
                        h(y, A)
                    })
                }
                z.ajaxForm(v)
            }
        }
        return this
    }
}(jQuery));
