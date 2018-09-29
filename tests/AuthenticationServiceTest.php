<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 07:45
 */

namespace Tests;

use App\AuthenticationService;
use App\ILogger;
use App\IProfile;
use App\IToken;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;

class AuthenticationServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    /** @test */
    private $stubProfile;
    private $stubToken;
    private $target;
    private $mockLogger;

    protected function setUp()
    {
        $this->stubProfile = m::mock(IProfile::class);
        $this->stubToken = m::mock(IToken::class);

        $this->mockLogger = m::mock(ILogger::class);

        $this->target = new AuthenticationService($this->stubProfile, $this->stubToken, $this->mockLogger);
    }

    public function test_is_valid()
    {
        $this->givenProfile('joey', '91');
        $this->givenToken('000000');

        $this->shouldBeValid('joey', '91000000');
    }

    public function test_should_log_account_when_invalid()
    {
        $this->givenProfile('joey', '91');
        $this->givenToken('000000');

//        $this->mockLogger->shouldReceive('save')->with('account: joey try to login failed')
//            ->once();

        $this->mockLogger->shouldReceive('save')->with(m::on(function ($message) {
            return strpos($message, 'joey') !== false;
        }))->once();

        $this->target->isValid('joey', 'wrong password');
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
