<?php
use App\Team;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @test a team has name
     */
    public function a_team_has_name ()
    {
        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme', $team->name);
    }

    /**
     * @test a team can add member
     */
    public function a_team_can_add_members ()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $team->add($user);
        $team->add($userTwo);

        $this->assertEquals(2, $team->count());
    }
}
