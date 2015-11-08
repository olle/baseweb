<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2008-2009
 *
 * THIS CODE IS PROPRIETARY AND PROTECTED BY COPYRIGHT LAW AGAINST COPYING,
 * RE-DISTRIBUTION, PUBLISHING OR DE-COMPILATION WITHOUT THE PRIOR WRITTEN
 * CONSENT OF THE AUTHOR. USAGE IS CONTROLLED BY A LICENSE AGREEMENT,
 * REGULATING THE SPECIFIC, UNIQUE, NON EXCLUSIVE RIGHTS TO RUN, USE OR
 * INCLUDE THE CODE IN WHOLE, PART, COMPILED OR DECOMPILED FORM.
 */
/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-25
 */
class Html extends Baseweb_Module {
	
	const MODULE_NAME = 'html';
	
	// VARIABLES
	
	protected $name = self::MODULE_NAME;
	
	private $footer = array();
	private $header = array();

	// PUBLIC METHODS
	
	public function addToFooter($content) {

		$this->footer[] = $content;	
	}
	
	public function getFooter() {
		
		foreach ($this->footer as $footi)
			echo $footi . "\n";
	}
	
	public function addToHeader($content) {
		
		$this->header[] = $content;
	}
	
	public function getHeader() {
		
		foreach ($this->header as $headi)
			echo $headi . "\n";
	}
	
	public function hidden($name, $value = null) {
		
		echo '<input type="hidden" name="', $name, '" value="', ($value !== null ? $value : ''), '" />';
	}

	public function label($for, $title = '', $errors = null) {

		if (func_num_args() == 1) {
			$title = $for;
			$for = null;			
		}
	
		if ($errors && $errors->contains($for))
			$class = ' class="error"';
		else
			$class = '';

		echo '<label ', ($for !== null) ? 'for="' .  $for . '"' : '', $class, '>', $title, '</label>';
	}
	
	public function legend($text, $params = array()) {
		
		$p = new Baseweb_Params($params);
		
		$class = 'legend';
		
		if ($p->class)
			$class .= ' ' . $p->class;
		
		echo '<p class="', $class, '">', $text, '</p>';
	}
	
	public function file($name, $params = array()) {
		
		$p = new Baseweb_Params($params);
		
		echo '<input type="file" name="', $name, '"';
		
		if ($p->value)
			echo ' value="', $p->value, '"';
		
		if ($p->class)
			echo ' class="', $p->class, '"';
			
		if ($p->id)
			echo ' id="', $p->id, '"';
			
		echo ' />';
	}
	
	public function input($name, $value = null, $params = array()) {
		
		$p = new Baseweb_Params($params, array('type' => 'text'));
		
		echo '<input type="', $p->type, '" name="', $name, '" value="', ($value !== null ? htmlspecialchars($value) : ''), '"';
		
		if ($p->class)
			echo ' class="', $p->class, '"';
		
		echo ' />';
	}
	
	public function checkbox($name, $value, $comparedTo = null) {
		
		if (isset($comparedTo) && $comparedTo == $value)
			$checked = ' checked="checked"';
		else
			$checked = '';
			
		echo '<input type="checkbox" name="', $name, '" value="', ($value !== null ? $value : ''), '"', $checked, '/>';
	}
	
	public function textarea($name, $value = null, $cols = 80, $rows = 7, $params = array()) {
		
		$p = new Baseweb_Params($params);
		
		echo '<textarea name="', $name, '" cols="', $cols, '" rows="', $rows, '"';
		
		if ($p->id)
			echo ' id="', $p->id, '"';
		
		echo '>', ($value !== null ? $value : ''), '</textarea>';
	}
	
	public function submit($value) {
		
		echo '<input type="submit" value="', htmlspecialchars($value), '" />';
	}

	public function button($text, $params = array()) {
		
		$p = new Baseweb_Params($params);

		echo '<button';
		
		if ($p->type)
			echo ' type="', $p->type, '"';
			
		if ($p->id)
			echo ' id="', $p->id, '"';
			
		if ($p->name)
			echo ' name="', $p->name, '"';
			
		if ($p->value)
			echo ' value="', $p->value, '"';
			
		if ($p->class)
			echo ' class="', $p->class, '"';
			
		if ($p->disabled)
			echo ' disabled="', $p->disabled, '"';
			
		if ($p->title)
			echo ' title="', $p->title, '"';
			
		if ($p->style)
			echo ' style="', $p->style, '"';
		
		echo '><span>';
		
		if ($p->img)
			echo '<img src="', $p->img, '" alt="', $p->alt, '" /> ';
		
		echo $text, '</span></button>';
	}
	
	public function actionError($error, $l10n = 'txt', $prefix = 'error.') {
		
		if ($error) {
			echo '<div class="error">';
			echo '<h3>', call_user_func($l10n, $prefix . $error->action), '</h3>';
			echo '<p>', call_user_func($l10n, $prefix . $error->code), '</p>';
			echo '</div>';
		}
	}
	
	public function formErrors($errors, $l10n = 'txt', $prefix = 'error.') {
		
		if ($errors) {
			
			echo '<ul class="errors clearfix">';
			echo '<h3>', call_user_func($l10n, 'Form errors'), '</h3>';
						
			foreach ($errors as $fieldName => $errorCodes) {

				echo '<h4>', call_user_func($l10n, ucfirst($fieldName)), '</h4>';
				echo '<li>';

				foreach ($errorCodes as $code)
					echo call_user_func($l10n, $prefix . $code);
					
				echo '</li>';
				
			}			
			echo '</ul>';
		}
	}
	
	/**
	 * @deprecated Use formErrors instead.
	 */
	public function errors($errors, $l10n = 'trim', $prefix = 'error.') {
		$this->formErrors($errors, $l10n, $prefix);
	}
	
	public function pagination($pager, $params = array()) {
		
		$p = new Baseweb_Params(
				$params,
				array(
						'chunk' => 5,
						'url' => '?&amp;page={%page_number}',
				)
		);
		
		$pagerRangeSettings = array('chunk' => $p->chunk);
		
		$layout = new Doctrine_Pager_Layout(
			$pager,
			new Doctrine_Pager_Range_Sliding($pagerRangeSettings),
      		$p->url
		);
		
		$pagerRange = new Doctrine_Pager_Range_Sliding($pagerRangeSettings, $pager);
		
		echo '[<a href="', str_replace('{%page_number}', $pager->getPreviousPage(), $p->url), '">&lt;</a>]';
		
		if (!$pagerRange->isInRange($pager->getFirstPage())) {
			echo '[<a href="', str_replace('{%page_number}', $pager->getLastPage(), $p->url), '">', $pager->getFirstPage(), '</a>]';
			echo '...';
		}
		
		$layout->display();

		if (!$pagerRange->isInRange($pager->getLastPage())) {
			echo '...';
			echo '[<a href="', str_replace('{%page_number}', $pager->getLastPage(), $p->url), '">', $pager->getLastPage(), '</a>]';
		}
		
		echo '[<a href="', str_replace('{%page_number}', $pager->getNextPage(), $p->url), '">&gt;</a>]';		
	}
	
}
