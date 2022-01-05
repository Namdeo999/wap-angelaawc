<?php

// function reportFilterHtml($wap_request){
//     $html = "";
//     foreach ($wap_request as $key => $item) {
        
//         $html .= "<tr>";
//         $html .= "<td>".++$key."</td>";
//         $html .= "<td>".$item->id."</td>";
//         $html .= "<td>".$item->client_mobile."</td>";
//         $html .= "<td>".$item->template_name."</td>";
//         $html .= "<td>";
//             $html .= "<div>".$item->user_name."</div>";
//             $html .= "<small class='dt_color'>".date('d-m-Y', strtotime($item->request_date)) . ' ' . $item->request_time."</small>";
//         $html .="</td>";
//         $html .= "<td>";
//             $html .="<div>".$item->admin_name."</div>";
//             $html .="<small class='dt_color'>".date('d-m-Y', strtotime($item->approve_date)) . ' ' . $item->approve_time."</small>";
//         $html .="</td>";
//         $html .= "<td></td>";
//         $html .= "</tr>";
//     }

//     return $html;
// }