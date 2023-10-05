@php
use App\Models\Profession;
function recur($id, $aa)
    {
        $bb = '<ul class="submenu">';
        for ($j = 0; $j < count($aa); $j++) {
            for ($k = 0; $k < count($aa[$j]->parent_profession); $k++) {
                if ($id == $aa[$j]->parent_profession[$k]) {
                    $temp = recur($aa[$j]->id, $aa);
                    $bb .= '<li' . ($temp == '<ul class="submenu"></ul>' ? '' : ' class="has-submenu"') . '><a href="#">' . $aa[$j]->name . '</a>' . $temp . '</li>';
                }
            }

        }

        $bb .= '</ul>';
        return $bb;
    }
        $aa = (Profession::all());
        $cc = (Profession::where('parent_profession', [])->get());
        $bb = '';
        for ($i = 0; $i < count($cc); $i++) {
            $temp = recur($cc[$i]->id, $aa);
            $bb .= '<li' . ($temp == '<ul class="submenu"></ul>' ? '' : ' class="has-submenu"') . '><a href="#">' . $cc[$i]->name . '</a>' . $temp . '</li>';
        } 
@endphp
{!!$bb!!}