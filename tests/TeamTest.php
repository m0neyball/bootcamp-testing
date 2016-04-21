<?php

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseTransactions;


    /** @test */
    function a_team_has_a_name()
    {
        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme', $team->name);
    }
    

    /** @test */
    function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();

        $userTwo = factory(User::class)->create();

        $team->add($user);
        $team->add($userTwo);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    function a_team_has_a_maximun_size()
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

    /** @test */
    function a_team_can_add_multiple_members_at_one()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());

    }

    /** @test */
    function a_team_can_remove_a_member()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $team->remove($users[1]);

        $this->assertEquals(1, $team->count());

    }

    /** @test */
    function a_team_can_remove_more_than_one_member_at_once()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 5)->create();

        $team->add($users);

        $team->removeAll();

        $this->assertEquals(0, $team->count());
    }
}
