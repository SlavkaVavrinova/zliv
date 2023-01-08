<?php

declare(strict_types=1);

namespace App\Model;

use App\Forms\ReservationsForm\RezervationsDbFormData;
use Nette\Database\Explorer;

class ReservationsFacade
{
	private Explorer $db;


	public function __construct(Explorer $db)
	{
		$this->db = $db;
	}

//	public function addReservation(RezervationsDbFormData $data)
//	{
//
//        $this->db->query('INSERT INTO `rezervationsDb`', (array) $data);
//
//	}

	public function getAllReservations()
	{
		return $this->db->table('rezervationsDb')
			->order('id ASC');
		/*return $this->db->query('
			SELECT *
			FROM posts
			ORDER BY id DESC
		');*/
	}

    public function getReservation(int $id)
    {
        return $this->getAllReservations()->where('id', $id)->fetch();
    }

    public function updateReservation(RezervationsDbFormData $data)
    {
        $this->db->table('rezervationsDb')
            ->where('id', $data->id)
            ->update((array) $data);
    }

    public function delete(int $id)
	{
		$this->db->table('rezervationsDb')
			->where('id', $id)
			->delete();
	}
}
