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

    /**
     * @test a team can add multiple members at once
     */
    public function a_team_can_add_multiple_members_at_once ()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class, 2)->create();

        $team->add($user);

        $this->assertEquals(2, $team->count());
    }

    /**
     * @test a team has a maximum size
     */
    public function a_team_has_a_maximum_size ()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $team->add($userOne);
        $team->add($userTwo);

        $this->assertEquals(2, $team->count());

        $this->setExpectedException('Exception');

        $userThree = factory(User::class)->create();
        $team->add($userThree);
    }

    /**
     * @test a team can remove a member
     */
    public function a_team_can_remove_a_member ()
    {

    }

    /**
     * @test a team can remove all members at once
     */
    public function a_team_can_remove_all_members_at_once ()
    {

    }
}
