<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 07:45
 */

namespace Tests;

use App\AuthenticationService;
use App\IProfile;
use App\IToken;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;

class AuthenticationServiceTest extends TestCase
{
    /** @test */
    private $stubProfile;
    private $stubToken;
    private $target;

    protected function setUp()
    {
        $this->stubProfile = m::mock(IProfile::class);
        $this->stubToken = m::mock(IToken::class);
        $this->target = new AuthenticationService($this->stubProfile, $this->stubToken);
    }

    public function test_is_valid()
    {
        $this->givenProfile('joey', '91');
        $this->givenToken('000000');

        $this->shouldBeValid('joey', '91000000');
    }

    private function givenProfile($account, $password): void
    {
        $this->stubProfile->shouldReceive('getPassword')
            ->with($account)
            ->andReturn($password);
    }

    private function givenToken($token): void
    {
        $this->stubToken->shouldReceive('getRandom')
            ->andReturn($token);
    }

    private function shouldBeValid($account, $password): void
    {
        $this->assertTrue($this->target->isValid($account, $password));
    }
}

//class StubProfile implements IProfile
//{
//    public function getPassword($account)
//    {
//        if ($account=='joey') {
//            return '91';
//        }
//        return'';
//    }
//}
//
//class StubToken implements  IToken
//{
//    public function getRandom($account)
//    {
//        return '000000';
//    }
//}
