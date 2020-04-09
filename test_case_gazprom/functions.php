<?php
function getStructure($data, $structure)
{
    $key = array_key_first($data);
    if (is_array($data[$key])) {
        if (count($data[$key]) > 1) {
            $structure[$key] = $data[$key];
            return $structure;
        } elseif (count($data[$key]) === 1) {
            $structure[$key] = getStructure($data[$key], $structure[$key]);
            return $structure;
        }
    }
    return null;
}

function getSortStructure($structure_data)
{
    if (is_array($structure_data)) {
        ksort($structure_data);
        foreach ($structure_data as &$temp) {
            if (is_array($temp)) {
                $temp = getSortStructure($temp);
            }
            unset($temp);
        }
    }
    return $structure_data;
}

function getUls($structure_sort, $html, $pos)
{
    if (is_array($structure_sort)) {
        $ul = '';
        foreach ($structure_sort as $key => $temp_data) {
            if (!in_array($key, ['title', 'value'])) {
                $position = empty($pos) ? $key : $pos . '.' . $key;
                $ul .= '<ul>';
                $ul .= getUls($temp_data, $html, $position);
                $ul .= '</ul>';
            } else {
                $li[] = $temp_data;
            }
        }
        if (!empty($li)) {
            $html .= '<li class="row"><div class="position">' . $pos . '</div><div class="title">' . $li[0] . '</div><div class="price">' . $li[1] . '</div></li>';
            unset($li);
        }
        if (!empty($ul)) {
            $html .= $ul;
        }
        return $html;
    }
    return 'error data';
}

/*function d($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}*/