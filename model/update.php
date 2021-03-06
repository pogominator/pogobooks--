<?php 
	
	include '../controller/db_crud.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: ../view/adminpanel.php");
	}

if ( !empty($_POST)) {
		// keep track validation errors
	
		$titluError = null;
		$autorError = null;
		$imgError = null;
		$pretError = null;
		$an_aparitieError = null;
		$edituraError = null;
		$nr_paginiError = null;
		$deskError = null;
		$keywordsError = null;
		
		// keep track post values
	
		$titlu = $_POST['titlu'];
		$autor = $_POST['autor'];
		$img = $_POST['img'];
		$pret = $_POST['pret'];
		$an_aparitie = $_POST['an_aparitie'];
		$editura = $_POST['editura'];
		$nr_pagini = $_POST['nr_pagini'];
		$desk = $_POST['desk'];
		$keywords = $_POST['keywords'];



		// validate input
		$valid = true;
		if (empty($titlu)) {
			$titluError = 'Please enter booktitle';
			$valid = false;
		}
        
        	if (empty($autor)) {
			$autorError = 'Please enter author';
			$valid = false;
		    }

		    	if (empty($img)) {
			$imgError = 'Please insert book cover';
			$valid = false;
		}
		
			if (empty($pret)) {
			$pretError = 'Please enter bookprice';
			$valid = false;
		}

			if (empty($an_aparitie)) {
			$an_aparitieError = 'Please enter year';
			$valid = false;
		}


			if (empty($editura)) {
			$edituraError = 'Please enter publisher';
			$valid = false;
		}


			if (empty($nr_pagini)) {
			$nr_paginiError = 'Please enter page number';
			$valid = false;
		}
			if (empty($desk)) {
			$deskError = 'Please enter description';
			$valid = false;
		}

		  if( empty($keywords)){
		  	$keywordsError = 'Please enter keywords';
		    $valid = false;
		  }


		if ($valid) {
			$pdo = db_crud::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE products  set titlu = ?, autor = ?, img = ? pret = ? an_aparitie = ? editura = ?
			        nr_pagini = ? , desk = ? , keywords = ? WHERE id = ?" ;
			$q = $pdo->prepare($sql);
			$q->execute(array($titlu,$autor,$img,$pret,$an_aparitie,$editura,$nr_pagini,$desk,$keywords,$id));
			header("Location: ../view/adminpanel.php");
			db_crud::disconnect();
		}
	} else {
		$pdo = db_crud::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM products where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$titlu = $_POST['titlu'];
		$autor = $_POST['autor'];
		$img = $_POST['img'];
		$pret = $_POST['pret'];
		$an_aparitie = $_POST['an_aparitie'];
		$editura = $_POST['editura'];
		$nr_pagini = $_POST['nr_pagini'];
		$desk = $_POST['desk'];
		$keywords = $_POST['keywords'];

		db_crud::disconnect();
		header("Location: ../view/adminpanel.php");
	}