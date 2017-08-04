<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Connection;

class ActivationRepository extends Model
{

    protected $db;
    protected $table = 'user_activations';
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

	/**
	 * [getToken : encode token]
	 * @return [hash_mac] 
	 */
    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    /**
     * [createActivation description: ]
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function createActivation($user)
    {

        $activation = $this->getActivation($user);

        if (!$activation) {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }

    /**
     * [regenerateToken description : update token user in database user_activations table]
     * @param  $user
     * @return $token
     */
    private function regenerateToken($user)
    {

        $token = $this->getToken();
        $this->db->table($this->table)->where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    /**
     * [createToken description: insert token user in database user_activations table]
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    private function createToken($user)
    {
        $token = $this->getToken();
        $this->db->table($this->table)->insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    /**
     * [getActivation description: get infomation by user_id in user_activations table]
     * @param  [type] $user [description]
     * @return 
     */
    public function getActivation($user)
    {
        return $this->db->table($this->table)->where('user_id', $user->id)->first();
    }

    /**
     * [getActivationByToken description: get infomation by token in user_activations tabl]
     * @param  [type] $token [description]
     * @return 
     */
    public function getActivationByToken($token)
    {
        return $this->db->table($this->table)->where('token', $token)->first();
    }

    /**
     * [deleteActivation description : delete infomation in database by token of user_id]
     * @param  [type] $token [description]
     * @return 
     */
    public function deleteActivation($token)
    {
        $this->db->table($this->table)->where('token', $token)->delete();
    }

}