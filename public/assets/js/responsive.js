/**
 * @responsive js for (online e-vote)
 *
 * @project     - online e-vote
 * @author      -
 * @created_by  -
 * @created_at  -
 * @modified_by -
 */

$(function () {
    if (window.matchMedia("(max-width: 992px)").matches) {
        // append btnSidebarToggle
        // with styling
        let btnSidebarToggle = `<button class="btn btn-sidebar-toggle me-2 flex-shrink-0"> <i class="bi bi-list"></i>  </button>`;
        $(".header .header-left .theme-logo").before(btnSidebarToggle);
        $(document).find(".btn-sidebar-toggle").css({
            width: "45px",
            height: "45px",
            padding: "0px",
            fontSize: "32px",
        });

        // #navigation-sidebar css append
        let styleWithoutCollapsed = function () {
            $("#navigation-sidebar").css({
                transform: "translateX(-100%)",
                opacity: "0",
                visibility: "hidden",
                borderRadius: "4px",
            });
        };
        let styleWithCollapsed = function () {
            $("#navigation-sidebar").css({
                transform: "translateX(0",
                opacity: "1",
                visibility: "visible",
            });
        };
        styleWithoutCollapsed();

        // click event handler
        $(document).on("click", ".btn-sidebar-toggle", function (e) {
            e.preventDefault();
            $(this).find(".bi").toggleClass("bi-x bi-list");
            $("body , #navigation-sidebar").toggleClass("sidebar-collapsed");
            if ($("#navigation-sidebar").hasClass("sidebar-collapsed")) {
                styleWithCollapsed();
            } else {
                styleWithoutCollapsed();
            }
        });

        // .eVote-table top responsiveness
        $(".eVote-table > .d-flex").addClass("flex-wrap");
        $(".eVote-table > .d-flex > h5").addClass("mb-3 mb-sm-0");
        $(".eVote-table .pagination-nav")
            .removeClass("text-end")
            .addClass("mt-3");
    } else {
        // $('.btn-sidebar-toggle').remove()
        if ($(document).find(".btn-sidebar-toggle").length) {
            $(document).find(".btn-sidebar-toggle").remove();
        }

        // .eVote-table top responsiveness
        $(".eVote-table > .d-flex").removeClass("flex-wrap");
        $(".eVote-table > .d-flex > h5").removeClass("mb-3 mb-sm-0");
        $(".eVote-table .pagination-nav")
            .addClass("text-end")
            .removeClass("mt-3");
    }
});
