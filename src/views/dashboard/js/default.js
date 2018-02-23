$(() => {
    listingItem = (id, value) => `<div>${value}<a id="listing${id}" href="#">X</a></div>`;
    $.get('dashboard/xhrGetListings', (response) => {
        for (let i = 0; i < response.length; i++) {
            const o = response[i];
            $('#listInsert').append(listingItem(o.id, o.value));
            $(`#listing${o.id}`).click(() => {
                $.post('dashboard/xhrDeleteListing', { id: o.id }, (response) => {
                    $(`#listing${o.id}`).parent().remove();
                });
            });
        }
    }, 'json');

    const randomInsert = '#randomInsert';
    $(randomInsert).submit(() => {
        try {
            var data = $(randomInsert).serialize();
            var url = $(randomInsert).attr('action');
            $.post(url, data, (response) => {
                $('#listInsert').append(listingItem(response.id, response.value));
            }, 'json');
            return false;
        } catch (error) {
            console.log(error);
            return false;
        }
    });
})