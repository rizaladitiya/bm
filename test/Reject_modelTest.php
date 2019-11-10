<?php
// tests/PostTest.php
class Reject_modelTest extends PHPUnit_Framework_TestCase {
	private $CI;

	public function setUp() {
		$this->CI = &get_instance();
	}

	public function testGetAllPosts() {
		$this->CI->load->model('reject_model');
		$posts = $this->CI->reject_model->get_by_all()->result_array();
		$this->assertEquals(5, count($posts));
	}
}