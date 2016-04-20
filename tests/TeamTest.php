<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Team;

class TeamTest extends TestCase
{
    /**
     * @test
     */
    public function a_team_has_a_name ()
    {
        $team = new Team(['name' => 'Acme']);
        $this->assertEquals ('Acme', $team->name);
    }
}
