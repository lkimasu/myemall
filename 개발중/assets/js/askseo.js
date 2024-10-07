/* Bootstrap basic */


if (BB_MEMO_POPUP === false) {
    /**
     * 쪽지 팝업 사용안함
     **/
    var win_memo = function (href) {
        const targetId = $('#memo-modal');
        const memoModal = new bootstrap.Modal(targetId, {});
        memoModal.show();
        targetId.find('#memo-iframe').attr('src', href);
    }
}

if (BB_MAIL_POPUP === false) {

    /**
     * 메일 창
     **/
    var win_email = function (href) {
        const targetId = $('#mail-modal');
        const memoModal = new bootstrap.Modal(targetId, {});
        memoModal.show();
        targetId.find('#mail-iframe').attr('src', href);
    }
}
if (BB_PROFILE_POPUP === false) {
    /**
     * 자기소개 창
     **/
    var win_profile = function (href) {
        const targetId = $('#profile-modal');
        const memoModal = new bootstrap.Modal(targetId, {});
        memoModal.show();
        targetId.find('#profile-iframe').attr('src', href);
    }
}
if (BB_SCRAP_POPUP === false) {
    /**
     * 스크랩 창
     **/
    var win_scrap = function (href) {
        const targetId = $('#scrap-modal');
        const memoModal = new bootstrap.Modal(targetId, {});
        memoModal.show();
        targetId.find('#scrap-iframe').attr('src', href);
    }
}
if (BB_POINT_POPUP === false) {
    /**
     * 포인트 창
     **/
    var win_point = function (href) {
        const targetId = $('#point-modal');
        const memoModal = new bootstrap.Modal(targetId, {});
        memoModal.show();
        targetId.find('#point-iframe').attr('src', href);
    }
}



if (BB_COUPON_POPUP === false) {
    /**
     * 영카트 쿠폰 창
     **/
    var win_coupon = function (href) {
        const targetId = $('#coupon-modal');
        const memoModal = new bootstrap.Modal(targetId, {});
        memoModal.show();
        targetId.find('#coupon-iframe').attr('src', href);
    }
}