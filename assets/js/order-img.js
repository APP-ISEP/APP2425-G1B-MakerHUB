var div = document.getElementById('modal');
var display=0;  

function HideShow()
{
    if(display==1)
    {
        div.style.display='block';
        display=0;
    }
    else
    {
        div.style.display='none';
        display==1;
    }
}
