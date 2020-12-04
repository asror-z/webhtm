window.onload = () => {
    loadData();
};

let radioBtns = document.querySelectorAll('input[type="radio"]');
radioBtns.forEach(item => {
    item.addEventListener('click', (event) => {
        loadData();
    })
});

function loadData() {
    $.ajax({
        url: '/kernel/product/getCompany.aspx',
        type: 'GET',
        data: $("#formModal").serialize(),
        success: function (data) {
            $('.data').html(data);
            $('.market-company').removeClass('d-none');
            $('.data').addClass('d-none');
            setTimeout(function () {
                $('.market-company').addClass('d-none');
                $('.data').removeClass('d-none');
            }, 3000)


        }
    });
}
