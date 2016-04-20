<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Team;
use App\User;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function a_team_has_a_name ()
    {
        $team = new Team(['name' => 'Acme']);
        $this->assertEquals ('Acme', $team->name);
    }

    /**
     * @test
     */
    public function a_team_can_add_members ()
    {
        $team = factory (Team::class)->create ();
        $user1 = factory (User::class)->create ();
        $user2 = factory (User::class)->create ();
        $team->add ($user1);
        $team->add ($user2);
        $this->assertEquals (2, $team->count ());
    }
}
