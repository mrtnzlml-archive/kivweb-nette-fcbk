<?php

namespace App\Model;

use Nette;

class Posts extends Nette\Object {

	const TABLE_NAME = 'posts';
	const COLUMN_ID = 'id';
	const COLUMN_CONTENT = 'content';
	const COLUMN_DATE = 'date';

	/** @var Nette\Database\Context */
	private $database;

	/**
	 * @param Nette\Database\Context $database
	 */
	public function __construct(Nette\Database\Context $database) {
		$this->database = $database;
	}

	///// CRUD /////

	/**
	 * @param array $data
	 * @return bool|int|Nette\Database\Table\IRow
	 */
	public function create(array $data) {
		return $this->database->table(self::TABLE_NAME)->insert($data);
	}

	/**
	 * @param null $id
	 * @return bool|mixed|Nette\Database\Table\IRow|Nette\Database\Table\Selection
	 */
	public function read($id = NULL) {
		$selection = $this->database->table(self::TABLE_NAME)->order('date DESC');
		if ($id === NULL) {
			return $selection;
		}
		return $selection->where('id = ?', $id)->fetch();
	}

	/**
	 * @param $id
	 * @param array $data
	 * @return int
	 */
	public function update($id, array $data) {
		return $this->database->table(self::TABLE_NAME)->where('id = ?', $id)->update($data);
	}

	/**
	 * @param $id
	 * @return int
	 */
	public function delete($id) {
		return $this->database->table(self::TABLE_NAME)->where('id = ?', $id)->delete();
	}

}
