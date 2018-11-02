<?php

// Redirection vers une autre page
function redirect($page)
{
	header('Location: '.$page);
}

// Formate et stylise les prix
function formatPrice(int $price, int $id_typeLogement = null) {
	$price = number_format($price, 2, ',', ' ');
	$price = str_replace(',', '', $price);
	$price = str_replace('.', '', $price);
	$first = substr($price, 0, -2);
	if (!empty($id_typeLogement))
		$first = ($id_typeLogement===1) ? $first."€ /mois" : $first."€";
    return $first;
}

