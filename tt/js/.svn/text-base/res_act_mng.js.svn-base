
function show_res(disp)
{
    el = document.getElementById('CLASS_res');
    el.style.display = disp;
    el = document.getElementById('PROF_res');
    el.style.display = disp;
    el = document.getElementById('ROOM_res');
    el.style.display = disp;
    el = document.getElementById('show_lnk');
    if (disp == 'none')
    {
        disp = 'block';
        el.innerHTML = 'show';
    }
    else
    {
        disp = 'none';
        el.innerHTML = 'hide';
    }
    el.href = 'javascript:show_res(\'' + disp + '\')';
}
function show_activity(disp,cat)
{
    el = document.getElementById('act_' + cat);
    el.style.display = disp;
    el = document.getElementById('show_lnk_act_' + cat);
    if (disp == 'none')
    {
        disp = 'block';
        el.innerHTML = 'show';
    }
    else
    {
        disp = 'none';
        el.innerHTML = 'hide';
    }
    el.href =
        'javascript:show_activity(\''+disp+'\',\''+cat+'\')';
}
