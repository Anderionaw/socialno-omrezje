<?php

/**
 * Generates copyright string!
 *
 * @param integer $startYear The year copyright enters into force.
 * @param string $copyrightString Copyright string ('Copyright &copy;' by default)
 * @return string Copyright string with date interval determined by startYear and current date!
 */

function copyright($startYear, $copyrightString = 'Copyright &copy; %s') {

    $year = date('Y');
    $year = ($year > $startYear) ? "$startYear - $year" : "$startYear";
    return sprintf($copyrightString, $year);

}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Truncates text approximately to given length without breaking words.
 * @param $text Text to be truncated.
 * @param $length Approximate text length.
 * @return string Truncated text.
 */

function shorten($text, $length) {

	$length = abs((int)$length);
	if(strlen($text) > $length) {
		$text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
	}

	return $text;

}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Get current date
 */

function getCurrentDate() {

    return date('Y-m-d');
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Get formated date
 */

function getFormatedDate($date, $time = false) {
    
    if ($date) {
        if ($time) {
            $formated_date = date('d.m.Y h:i:s', strtotime($date));
        } else {
            $formated_date = date('d.m.Y', strtotime($date));
        }
        return($formated_date);
    } else {
        return '';
    }
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Clean array without selected empty key
 */

function cleanEmptyArrayData($data, $trigger = false) {

    $clean_data = array();

    if (!empty($data) && $trigger) {
        foreach($data as $key => $item) {
            if ($item[$trigger]) {
                $clean_data[$key] = $item; 
            }
        }
    }

    return $clean_data;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Clean array for relation syncing without selected empty key
 */

function cleanSyncArrayData($data, $trigger = false) {

    $synced_data = array();

    if (!empty($data) && $trigger) {

        foreach($data as $key => $item) {
            if ($item[$trigger]) {
                $synced_data[$item[$trigger]] = $item; 
            }
        }

    }

    return $synced_data;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Format active badge
 */

function formatActive($data, $margin = '', $has_title = false) {
    
    $mct_active = '';

    $title = ($has_title) ? 'style="display:inline-block;"' : '';

    if ($data && $data == 1) {
        //$mct_active = '<span class="badge badge-pill badge-success mb-1">' . __('Aktivno') . '</span>';
        $title = ($has_title) ?  __('Aktivno') : '';
        $mct_active = '<span class="mct_icon_active ' . $margin . '"><i class="ik ik-check-circle"></i></span>' . $title;
    } else {
        //$mct_active = '<span class="badge badge-pill badge-danger mb-1">' . __('Neaktivno') . '</span>';
        $title = ($has_title) ?  __('Neaktivno') : '';
        $mct_active = '<span class="mct_icon_unactive ' . $margin . '"><i class="ik ik-x-circle"></i></span>' . $title;
    }

    return $mct_active;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Format programs active badge
 */

function formatProgramActive($data, $title = '', $inline = false, $is_text = false) {
    
    $mct_active = '';

    if ($title && $title != '') { 
        $mct_active .= '<span class="mr-1">' . $title . ': </span>'; 
    }

    $class = ($data == 1) ? 'bg-green' : 'bg-red';
    $style = ($inline) ? 'style="display:inline-block;"' : '';
    $text = ($data == 1) ? __('Zaključeno') : __('Aktivno');

    if ($is_text) {
        $mct_active .= '<div class=""'. $style . '><span class="p-status mr-2 ' . $class . '" style="display:inline-block;"></span><span class="fw-700">' . $text . '</span></div>';
    } else {
        $mct_active .= '<div class="p-status ' . $class . '"' . $style . '></div>';
    }

    return $mct_active;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Get formated money
 */

function getFormatedMoney($number = 0, $no_curr = false) {

    if ($no_curr) {
        $formated_money = number_format($number, 2, ',', '');
    } else {
        $formated_money = number_format($number, 2, ',', '') . ' ' . config('mct-app.app_currency');
    }
    
    return $formated_money;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Get formated action type
 */

 function getFormatedActionStatus($type) {

    $formatedType = '';
    
    if ($type) {
        
        if ($type == 'fizicne') {
            $formatedType = '<span class="mct-fs-15 mr-1"><i class="ik ik-user"></i></span>' . __('Fizične osebe'); 
        } else {
            $formatedType = '<span class="mct-fs-15 mr-1"><i class="ik ik-cpu"></i></span>' . __('Pravne osebe');    
        }
    }    

    return $formatedType;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Get all donor statuses
 */

 function mctGetDonorStatuses() {

    $donorStatuses = array(
        'active' => 'Aktivni',
        'inactive' => 'Neaktivni',
        'regular' => 'Redni',
        'online' => 'Online',
        'permanent_deletion' => 'Trajno izbrisani'
    );
    
    return $donorStatuses;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Format JSON text
 */

function getFormatedJsonText($data, $badge = false, $assoc = false) {
    
    $formatedJson = '';

    if ($data) {

        $formatedData = json_decode($data);

        if(!empty($formatedData)) {
            
            if ($assoc) {

                foreach ($formatedData as $item) {
                    if($badge) {
                        $formatedJson .= '<a href="#" style="display:inline-block!important;" class="badge badge-secondary mb-1 mr-1">' . $item->text . '</a>';
                    } else {
                        $formatedJson .= $item->text . ', ';   
                    }
                }

            } else {
            
                if($badge) {
                    foreach ($formatedData as $item) {
                        $formatedJson .= '<a href="#" style="display:inline-block!important;" class="badge badge-secondary mb-1 mr-1">' . $item . '</a>';
                    }
                } else {
                    $formatedJson = implode(', ', $formatedData);
                }
            
            }

        }

    }

    return $formatedJson;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Format JSON array
 */

function getFormatedJsonTexts($data, $is_amount = false, $is_html = true) {
    
    $formatedJson = '';

    if ($data) {
        $formatedData = json_decode($data);
        if (!empty($formatedData)) {
            
            if ($is_html) {

                $formatedJson .= '<ul style="margin:0;padding:0 0 0 15px;">';
                $i=0; foreach ($formatedData as $key => $item) { $i++;
                    $formatedJson .= '<li>';
                    $formatedJson .= $item->text;
                    if ($is_amount && isset($item->amount)) {
                        $formatedJson .= ' - ' . $item->amount . ' ' . config('mct-app.app_currency');
                    }
                    $formatedJson .= '</li>';
                }
                $formatedJson .= '</ul>';

            } else {

                $i=0; foreach ($formatedData as $key => $item) { $i++;
                    $formatedJson .= ($i > 1) ? ', ' : '';
                    $formatedJson .= $item->text;
                    if ($is_amount && isset($item->amount)) {
                        $formatedJson .= ' - ' . $item->amount . ' ' . config('mct-app.app_currency');
                    }
                }

            }

        } 

    }

    return $formatedJson;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Format Plain array
 */

function getFormatedPlainTexts($data, $is_list = false) {
    
    $formatedPlain = '';

    if ($data) {
        if ($is_list) {
            $formatedPlain .= '<ul style="margin:0;padding:0 0 0 15px;">';
            $i=0; foreach ($data as $key => $item) { $i++;
                $formatedPlain .= '<li>';
                $formatedPlain .= $item->name . ' ' . $item->surname . ': ' . getFormatedMoney($item->pivot->amount);
                $formatedPlain .= '</li>';
            }
            $formatedPlain .= '</ul>'; 
        } else {
            $i=0; foreach ($data as $key => $item) { $i++;
                $formatedPlain .= $item->name . ' ' . $item->surname . ': ' . getFormatedMoney($item->pivot->amount) . ' ';
            }
        }
    }

    return $formatedPlain;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Format perrmissions with badge
 */

function formatPermissionsWithBadge($data, $role = '') {
    
    $mct_badges = '';

    if ($data) {

        if ($role == 'Super Admin') {
            $mct_badges .= '<span class="badge badge-success m-1">' . __('Vse pravice') . '</span>';
        } else {
            foreach ($data as $key => $permission) {
                $mct_badges .= '<span class="badge badge-dark m-1">' . $permission->name . '</span>';
            }
        }

    }

    return $mct_badges;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Format roles with badge
 */

function formatRolesWithBadge($data) {
    
    $mct_badges = '';

    if ($data) {

        foreach ($data as $key => $role) {
            $mct_badges .= '<span class="badge badge-dark m-1">' . $role->name . '</span>';
        }
        
    }

    return $mct_badges;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Format roles with badge
 */

function getDataSelections($selection) {
    
    $mctSelections = array();

    if ($selection) {

        $selectionData = explode('|', $selection);
        if (!empty($selectionData)) {
            $mctSelections = $selectionData;
        }
        
    }

    return $mctSelections;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Get formatted suggested amount
 */

function getSuggestedAmount($number = 0) {

    $formated_amount = '<span class="fw-700">' . getFormatedMoney($number) . '</span>';

    if ($number > 0) {
        $formated_amount = '<span class="fw-700">' . getFormatedMoney($number) . '</span>';
    } 
    
    return $formated_amount;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Get formated remaining amount
 */

function getRemainingAmount($number = 0) {

    if ($number > 0) {
        $formated_amount = '<span class="fw-700 mct_allowed">' . getFormatedMoney($number) . '</span>';
    } else {
        //$number = 0;
        $formated_amount = '<span class="fw-700 mct_nonallowed">' . getFormatedMoney($number) . '</span>';
    }
    
    return $formated_amount;
    
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//

/**
 * Print_r v <pre> tagih
 */

function print_pre($text, $ret = false, $inStyles = array(), $debug = true) {

    $aStyles = array(
		"-webkit-border-radius" => "3px",
        "-moz-border-radius" => "3px",
        "border-radius" => "3px",
        "background-color" => "#F0F0F0",
        "padding" => "3px",
        "border" => "1px solid #A8A8A8",
		"word-wrap" => "break-word"
	);

    if (is_array($inStyles)){
        foreach($inStyles as $key => $value)
            $aStyles[$key] = $value;
    }

    $applyStyles = array();

    foreach($aStyles as $key => $value)
        array_push($applyStyles, $key . ": " . $value . ";");

    $return = '<pre style="'.implode(" ", $applyStyles).'">';

	if ($debug) {
		$backtrace = debug_backtrace();
		if (strpos($backtrace[0]["file"], "helpers.php") === false)
			$index =  0;
		else
			$index = (strpos($backtrace[0]["file"], dirname(__FILE__)) === false) ? 0 : 1;

		$return .= $backtrace[ $index ]["file"] . ", " . $backtrace[ $index ]["line"] . ":<br /><br />";
	}

	$return .= print_r($text, true);
	$return .= '</pre>';

    if($ret) return $return;
    print($return);

}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------//
