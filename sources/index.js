function show_(element) {
    let cards = ["#sign_up", "#log_in"]

    cards.forEach(e => {
        if (e != element)
        document.querySelector(e).style.display = 'none';
    });

    if (document.querySelector(element).style.display != 'block')
        document.querySelector(element).style.display = 'block';
    else
        document.querySelector(element).style.display = 'none';

}

function next_()
{
    window.location.href   = 'next.php';
}

function previous_()
{
    window.location.href   = 'previous.php';
}