/**
 * @Script js for (Template/Project Name)
 *
 * @project     - Project Name
 * @author      -
 * @created_by  -
 * @created_at  -
 * @modified_by -
 */

/**
 * ========================================================
 * this function execute when window properly loaded
 * ===========================================================
 */

window.BASE_URL = document.head.querySelector('meta[name="base-url"]').content;
window.CSRF_TOKEN = document.head.querySelector('meta[name="csrf-token"]').content;

/**
 * Ajax setup
 *
 * @by: Md. Masudul Kabirwindow.BASE_URL
 * @date: 24 Nov, 2021
 * @return: void
 */

(function ($) {
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    });
})(jQuery);

$(window).on("load", function () {
    // add class by document path
    $(function () {
        var CurrentUrl = document.URL;
        var CurrentUrlEnd = CurrentUrl.split("/").filter(Boolean).pop();

        $(".navbar-nav a").each(function () {
            var ThisUrl = $(this).attr("href");
            var ThisUrlEnd = ThisUrl.split("/").filter(Boolean).pop();
            if (ThisUrlEnd == CurrentUrlEnd) {
                $(this).addClass("active");
                if ($(".navbar-nav .dropdown-item").hasClass("active")) {
                    $(this).closest(".dropdown-menu").addClass("show");
                    $(this)
                        .closest(".dropdown")
                        .find(".dropdown-toggle")
                        .addClass("active");
                }
            }
        });
    });
});

/**
 * ========================================================
 * this function execute when DOM element ready
 * ===========================================================
 */

$(document).ready(function () {
    /**
     * @init  {datetimepicker}
     */
    $(function () {
        if ($(".date-picker").length) {
            $(".date-picker").datepicker({
                minDate: 0,
                dateFormat: "yy-mm-dd",
            });
        }
        if ($(".time-picker").length) {
            $(".time-picker").datetimepicker({
                format: "LT",
                icons: {
                    up: "bi bi-chevron-up",
                    down: "bi bi-chevron-down",
                },
            });
        }
    });

    /**
     * @method  {candidate-img-fil}
     */
    $(function () {
        $("#upload-file , .candidate-img-file").on("change", function (e) {
            let imgName = e.target.files[0].name;
            if (imgName !== null && imgName !== undefined) {
                $(this).closest("label").find(".title var").text(imgName);
            }
        });
    });

    /**
     * @method  {toggleFullScreen}
     * toggleFullScreen for the specific HTMlElement
     */
    $(function () {
        function toggleFullScreen(id) {
            var elem = document.getElementById(id);
            if (!document.fullscreenElement) {
                $("#" + id).css({overflowX: "hidden"});
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.webkitRequestFullscreen) {
                    / Safari /;
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    / IE11 /;
                    elem.msRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                    $("#" + id).removeAttr("style");
                }
            }
        }

        $(document).on(
            "webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange",
            function (e) {
                e.preventDefault();
                let text =
                    $("#btn-enterFullScreen").text() == "Full Screen View"
                        ? "Exit Full Screen View"
                        : "Full Screen View";
                $("#btn-enterFullScreen")
                    .toggleClass("btn-primary btn-danger")
                    .text(text);
            }
        );

        $("#btn-enterFullScreen").on("click", function (e) {
            e.preventDefault();
            toggleFullScreen("result");
        });
    });

    // add application custom form field
    // application form group sortable
    $(function () {
        function sortableInit() {
            if ($(".sortable").length) {
                $(".sortable")
                    .sortable({
                        revert: false,
                        handle: ".btn-handle",
                        cancel: "",
                    })
                    .disableSelection();
            }
        }

        sortableInit();

        if ($(".btn-add-field").length) {
            $("#form-body").on("click", ".btn-remove", function (e) {
                e.preventDefault();
                $(this).closest(".form-group").remove();
            });

            $("form.add-field-form").submit(function (e) {
                e.preventDefault();

                let label = $("#add-input-label").val() || null;
                let name = label.replace(/\s/g, "_").toLowerCase() || null;
                let placeholder = $("#add-input-placeholder").val() || name;
                let type = $("#add-input-type").val() || null;
                let isFieldRequired = $("#is-field-required").is(":checked");

                if (
                    label !== null &&
                    label !== "" &&
                    type !== null &&
                    type !== "" &&
                    name !== null &&
                    name !== "" &&
                    placeholder !== null &&
                    placeholder !== "" &&
                    isFieldRequired !== null &&
                    isFieldRequired !== ""
                ) {
                    let field = `
                            <div class="row align-items-center form-group mb-3">
								<label for="#" class="col-lg-3 col-form-label">${label}:</label>
								<div class="col flex-grow-1">
									<input type="${type}" is-required="${isFieldRequired}" name="${name}" placeholder="${placeholder}" class="form-control rounded-pill ps-4 disabled" readonly />
								</div>
								<div class="col flex-grow-0 d-flex align-items-center form-group-action">
									<button type="button" class="btn btn-sm btn-remove btn-danger">
										<i class="bi bi-x"></i>
									</button>
									<button type="button" class="btn btn-handle">
										<svg width="30" height="30" viewBox="0 0 30 30" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M20 16.25L28.705 21.3275L24.9887 22.39L27.645 26.9913L25.48 28.2413L22.8238 23.6413L20.045 26.3288L20 16.25ZM17.5 7.5H20V10H26.25C26.5815 10 26.8995 10.1317 27.1339 10.3661C27.3683 10.6005 27.5 10.9185 27.5 11.25V16.25H25V12.5H12.5V25H17.5V27.5H11.25C10.9185 27.5 10.6005 27.3683 10.3661 27.1339C10.1317 26.8995 10 26.5815 10 26.25V20H7.5V17.5H10V11.25C10 10.9185 10.1317 10.6005 10.3661 10.3661C10.6005 10.1317 10.9185 10 11.25 10H17.5V7.5ZM5 17.5V20H2.5V17.5H5ZM5 12.5V15H2.5V12.5H5ZM5 7.5V10H2.5V7.5H5ZM5 2.5V5H2.5V2.5H5ZM10 2.5V5H7.5V2.5H10ZM15 2.5V5H12.5V2.5H15ZM20 2.5V5H17.5V2.5H20Z"
												fill="black" />
										</svg>
									</button>
								</div>
							</div>`;

                    function inputReset() {
                        $("#add-input-placeholder").val("");
                        $("#addFieldModal").modal("toggle");

                        setTimeout(() => {
                            $("#add-input-label").val("");
                            $("#add-input-name").val("");
                            $("#is-field-required").trigger("click");
                            $("#add-input-type option").prop(
                                "selected",
                                function () {
                                    return this.defaultSelected;
                                }
                            );
                        }, 100);
                    }

                    if ($("#form-body .sortable").length > 0) {
                        if ($("#form-body .sortable .form-group").length > 0) {
                            $("#form-body .sortable .form-group:last").after(
                                field
                            );
                            inputReset();
                        } else {
                            $("#form-body .sortable").append(field);
                            inputReset();
                        }
                    } else {
                        $("#form-body").append(
                            `<div class="sortable"> ${field} </div>`
                        );
                        sortableInit();
                        inputReset();
                    }
                }
            });
        }
    });

    // candidate add
    $(function () {
        if ($("#btn-candidate-add").length) {
            $("#btn-candidate-add").on("click", function (e) {
                e.preventDefault();

                $.ajax({
                    url: BASE_URL + "/get-candidates-json",
                    type: "GET",
                    dataType: "json",
                })
                    .done(function (response) {
                        let candidates = response.data;

                        if (candidates == null) {
                            return alert("No data found.");
                        }

                        let candidateNumber =
                            $("#candidate-number").val() || null;
                        let ballot = function (id) {
                            let memberID =
                                id + Math.floor(Math.random() * 999999);
                            return `
                        <div class="candidate-widget pb-1 border-bottom mb-3">
                            <div class="row gx-1">
                                <div class="col-lg-3">
                                    <div class="widget-box border p-3">
                                        <p class="mb-0 lh-base candidate-name">
                                            <strong class="candidate-text">Candidate Name</strong> <br />
                                            <span class="candidate-id">(ID : ${memberID})</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget-box border p-3">
                                        <img src="${BASE_URL}/assets/img/no-image.png" alt="img" name="icon" class="img-fluid candidate-img" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="widget-box border-start border-top border-bottom p-3">
                                    <select name="candidates[${memberID}][id]" class="form-select rounded-pill candidate-name-control ps-4">
                                        <option selected disabled value=""> Select Candidate Name </option>
                                            ${candidates.map(function (
                                candidate
                            ) {
                                return `<option value="${
                                    candidate.id
                                }" data-icon="${
                                    candidate.icon
                                }"> ${
                                    candidate.name
                                } </option>    `;
                            })}
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div> `;
                        };

                        if (
                            candidateNumber !== null &&
                            candidateNumber > 0 &&
                            candidateNumber < 100
                        ) {
                            $("#candidates").html("");
                            for (let i = 1; i <= candidateNumber; i++) {
                                $("#candidates").append(ballot(i));
                            }
                            $("#create-candidate-form .btn-save").removeClass(
                                "d-none"
                            );
                        } else {
                            alert(
                                "The number of candidates is required in the field and you need to input less than 100 at once !!"
                            );
                        }
                    })
                    .fail(function (error) {
                    });
            });

            $("#candidates").on(
                "change",
                ".candidate-name-control",
                function (e) {
                    e.preventDefault();

                    let cName = `${$(this).find("option:selected").text()}`;
                    let _this = $(this);
                    let _thisValue = _this.val();
                    let letsGo = true;

                    $(this).closest('.candidate-widget').siblings().find('.candidate-name-control').each(function (index, cnc) {
                        if ($(cnc).val() === _thisValue) {
                            letsGo = false;
                            return false
                        } else {
                            letsGo = true;
                        }
                    });

                    if (letsGo === false) {
                        _this.prop('selectedIndex', 0);
                        $(this)
                            .closest(".candidate-widget")
                            .find(".candidate-img")
                            .attr("src", `${window.BASE_URL}/assets/img/no-image.png`);
                        $(this)
                            .closest(".candidate-widget")
                            .find(".candidate-name > .candidate-text")
                            .text(`Candidate Name`);
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.error('This Candidate Already Selected !!');
                        return
                    }

                    let cIcon = `${$(this)
                        .find("option:selected")
                        .data("icon")}`;
                    $(this)
                        .closest(".candidate-widget")
                        .find(".candidate-img")
                        .attr("src", cIcon);
                    $(this)
                        .closest(".candidate-widget")
                        .find(".candidate-name > .candidate-text")
                        .text(`${cName}`);
                }
            );

            $("#candidates").on(
                "change",
                ".candidate-img-file",
                function (event) {
                    let imgURL = URL.createObjectURL(event.target.files[0]);
                    $(this)
                        .closest(".candidate-widget")
                        .find(".candidate-img")
                        .attr("src", imgURL);
                }
            );
        }
    });

    // eVote-table-toggleAction
    $(function () {
        if ($(".eVote-table-toggleAction").length) {
            $(".eVote-table-toggleAction").on("click", ".btn", function (e) {
                e.preventDefault();
                $(".eVote-table-toggleAction > .btn").removeClass("active");
                $(this).addClass("active");
                if ($(e.target).hasClass("btn-show")) {
                    $(this)
                        .closest(".eVote-table")
                        .find(".voter-list , .pagination-nav")
                        .removeClass("d-none");
                } else if ($(e.target).hasClass("btn-hide")) {
                    $(this)
                        .closest(".eVote-table")
                        .find(".voter-list , .pagination-nav")
                        .addClass("d-none");
                }
            });
        }
    });

    /* @name    serializeFormData
     * @type    Plugin
     * @author  Abdullah Ubayed Tanvir
     * @created 25th October, 2017
     * @usage   $("#form").serializeFormData();
     * @desc    Serializes form data to help submit all types of form
     */
    (function ($) {
        // define new plugin
        $.fn.serializeFormData = function () {
            // set the form selector as a value of a variable
            var obj = $(this);
            var formData;

            // check if the browser supports JavaScript FormData object
            if (typeof FormData !== undefined) {
                //formData = new FormData(obj[0]);
                // declare an empty variable that will store the data of the form
                formData = new FormData();
                // loop through all files field into the form
                $.each($(obj).find("input[type='file']"), function (i, tag) {
                    // loop through the field
                    $.each($(tag)[0].files, function (i, file) {
                        // store field name and the file as an item of formdata object
                        formData.append(tag.name, file);
                    });
                });

                // serialize the form and store it in a variable
                var params = $(obj).serializeArray();

                // loop through the form fields
                $.each(params, function (i, el) {
                    // store field name and the value of it as an item of formdata object
                    formData.append(el.name, el.value);
                });
            } else {
                // store all fields but file data in formData variable as an object
                formData = $(obj).serialize();

                // alert the user about the compatibility
                alert(
                    "Your browser don't have the latest JavaScript engine. Please update your browser to get full featured experience!"
                );
            }

            // return formdata object
            return formData;
        };
    })(jQuery);

    /**
     * Ajax Call for Form Submission
     * @author      Md. Masudul Kabir
     * @modified     25-07-2017
     */
    $(function () {
        $(".formdata").submit(function (e) {
            e.stopPropagation();
            e.preventDefault();

            var form = $(this),
                link = form.attr("action");

            $(document).find(".form-alert-widget").remove();

            if (form.attr("enctype") === "multipart/form-data") {
                $.ajaxSetup({
                    processData: false,
                    contentType: false,
                    cache: false,
                });
                data = form.serializeFormData();
            } else {
                data = form.serialize();
            }

            $.post(link, data, function (response) {
                    if (response.status !== undefined && response.status === true) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success(response.message);
                    } else {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.warning(response.message);
                    }

                    // Redirect execution
                    if (response.redirect !== undefined && response.redirect.length > 0) {
                        setTimeout(function () {
                            document.location.href = response.redirect;
                        }, response.delay);
                    }
                },
                "json").fail(function (jqXHR, textStatus, errorThrown) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                toastr.error(jqXHR.responseJSON?.message ?? errorThrown);
            });
        });
    });
});

//delete method
function deleteBtn(url, id) {
    $.ajax({
        type: "GET",
        url: url + "/" + id,
        success: function (data) {
            console.log(data);
        },
    });
}

/**
 * handleUpdateSettingStatusOnChange
 *
 * @by Md. Masudul Kabir
 * @date 18 Jan, 2022
 * @return void
 */
$(function () {
    $(".handleUpdateSettingStatusOnChange").on("change", function (e) {
        let el = $(this);

        $.ajax({
            url: BASE_URL + "/ajax-change-setting-status",
            type: "PUT",
            data: {
                fieldName: el.attr("name"),
            },
            dataType: "json",
        }).done(function (response) {
            toastr.options.positionClass = "toast-bottom-right";
            toastr.info(response.message);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            toastr.options.positionClass = "toast-bottom-right";
            toastr.warning(jqXHR.responseJSON.message);
            el.prop("checked", !el.is(":checked"));
        });
    });
});

/**
 * handleUpdateSettingValueOnChange
 *
 * @by Md. Masudul Kabir
 * @date 18 Jan, 2022
 * @return void
 */
$(function () {
    $(".handleUpdateSettingValueOnChange").on("change", function (e) {
        let el = $(this);
        let data = {};
        data[el.attr("name")] = el.val();

        $.ajax({
            url: BASE_URL + "/ajax-change-setting-value",
            type: "PUT",
            data: data,
            dataType: "json",
        }).done(function (response) {
            toastr.options.positionClass = "toast-bottom-right";
            toastr.info(response.message);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            toastr.options.positionClass = "toast-bottom-right";
            toastr.warning(jqXHR.responseJSON.message);
        });
    });
});


/**
 * Trash or Delete record using ajax request
 *
 * @by: Md. Masudul Kabir
 * @date: 28 July, 2021
 * @return: void
 */
$(function () {
    $(document).on('click', '.btnTrashRecord, .btnDeleteRecord', function (e) {
        e.preventDefault();

        let el = $(this);
        let link = el.attr('href');

        if (confirm("Are you sure?")) {
            $.ajax({
                url: link,
                type: 'DELETE',
                dataType: 'json'
            }).done(function (response) {

                // Toast notification
                if (response.status !== undefined && response.status === true) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                    }
                    toastr.info(response.message);

                    // Remove the row
                    el.closest('tr').children('td').slideUp(200, function () {
                        el.parent('tr').remove();
                    });
                } else {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                    }
                    toastr.warning(response.message);
                }

                // Redirect location
                if (response.redirect !== undefined && response.redirect.length > 0) {
                    document.location.href = response.redirect;
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                toastr.error(jqXHR.responseJSON?.message ?? errorThrown);
            });
        }
    });
});

/**
 * Restore record using ajax request
 *
 * @by: Md. Masudul Kabir
 * @date: 28 July, 2021
 * @return: void
 */
$(function () {
    $(document).on('click', '.btnRestoreRecord', function (e) {
        e.preventDefault();

        let el = $(this);
        let link = el.attr('href');

        if (confirm("Are you sure?")) {
            $.ajax({
                url: link,
                type: 'PUT',
                dataType: 'json'
            }).done(function (response) {

                // Toast notification
                if (response.status !== undefined && response.status === true) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                    }
                    toastr.info(response.message);

                    // Remove the row
                    el.closest('tr').children('td').slideUp(200, function () {
                        el.parent('tr').remove();
                    });
                } else {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                    }
                    toastr.warning(response.message);
                }

                // Redirect location
                if (response.redirect !== undefined && response.redirect.length > 0) {
                    document.location.href = response.redirect;
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                toastr.error(jqXHR.responseJSON?.message ?? errorThrown);
            });
        }
    });
});

/**
 * Get voters counter, whose are selected to send email
 *
 * @by: Md. Masudul Kabir
 * @date: 28 July, 2021
 * @return: void
 */
$(function () {
    $(document).on('click', '.countVotersAsReceiver', function (e) {
        let el = $(this);
        let link = BASE_URL + '/count-voters-as-receiver';

        $.ajax({
            url: link,
            type: 'GET',
            data: {
                receiver_type_id: el.val()
            },
            dataType: 'json'
        }).done(function (response) {

            // Toast notification
            if (response.status !== undefined && response.status === true) {
                $('.showReceiverCounter').text(response?.data?.count);
            } else {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                toastr.warning(response.message);
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            }
            toastr.error(jqXHR.responseJSON?.message ?? errorThrown);
        });
    });
});

/**
 * Check all permissions checkbox according to module
 *
 * @by: Md. Masudul Kabir
 * @date: 12 Dec, 2022
 * @return: void
 */
$('.check-all-checkbox-row').on('click', function () {
    if ($(this).is(':checked')) {
        $(this).closest('tr').find('input[type="checkbox"]').each(function () {
            $(this).prop('checked', true);
        });
    } else {
        $(this).closest('tr').find('input[type="checkbox"]').each(function () {
            $(this).prop('checked', false);
        });
    }
});

/**
 * Set Cookie
 *
 * @param cname
 * @param cvalue
 * @param exdays
 */
window.setCookie = function (cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/**
 * Get Cookie
 *
 * @param cname
 * @returns {string}
 */
window.getCookie = function (cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

