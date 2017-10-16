<?php
// Copyright 2013 OCLC
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
// http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

use OCLC\Auth\WSKey;
use OCLC\Auth\AccessToken;
use GuzzleHttp\Psr7\Response;

class BibErrorTest extends \PHPUnit_Framework_TestCase
{
    
    function setUp()
    {
    	$options = array(
    			'authenticatingInstitutionId' => 128807,
    			'contextInstitutionId' => 128807,
    			'scope' => array('WorldCatMetadataAPI')
    	);
    	$this->mockAccessToken = $this->getMockBuilder(AccessToken::class)
    	->setConstructorArgs(array('client_credentials', $options))
    	->getMock();
    	
    	$this->mockAccessToken->expects($this->any())
    	->method('getValue')
    	->will($this->returnValue('tk_12345'));
    }
    
    /**
     * Create BibError
     */
    function testCreateBibError(){
        $error = new BibError();
        $this->assertInstanceOf('BibError', $error);
        return $error;
    }
    
    /**
     * Set Request Error
     * @depends testCreateBibError
     */
    function testSetRequestError($error){
        $request_error = new Response(401, [], '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><error><code type="http">401</code><message>AccessToken {tk_12345} is invalid</message><detail>Authorization header: Bearer tk_12345</detail></error>');
        $error->setRequestError($request_error);
        $this->assertAttributeInstanceOf("GuzzleHttp\Psr7\Response", 'requestError', $error);
        return $error;
    }
    
    /**
     * Set Request Error HTML returned
     * @depends testCreateBibError
     */
    function testSetRequestErrorHTML()
    {
    	$error = new BibError();
    	$request_error = new Response(401, ['Content-Type' => 'text/html;charset=utf-8'], '<html></html>');
    	$error->setRequestError($request_error);
    	$this->assertAttributeInstanceOf("GuzzleHttp\Psr7\Response", 'requestError', $error);
    	$this->assertAttributeEmpty('message', $error);
    	$this->assertAttributeEmpty('detail', $error);
    }
    
    /**
     * Get Request Error
     * @depends testSetRequestError
     */
    function testGetRequestError($error){
        $this->assertInstanceOf("GuzzleHttp\Psr7\Response", $error->getRequestError());
        return $error;
    }
    
    /**
     * Get Code
     * @depends testGetRequestError
     */
    function testGetCode($error) {
        $this->assertEquals('401', $error->getCode());
    }
    
    /**
     * Get Message
     * @depends testGetRequestError
     */
    function testGetMessage($error) {
        $this->assertEquals('AccessToken {tk_12345} is invalid', $error->getMessage());
    }
    
    /**
     * Get Detail
     * @depends testGetRequestError
     */
    function testGetDetail($error) {
        $this->assertEquals('Authorization header: Bearer tk_12345', $error->getDetail());
    }
    
    /**
     * @vcr failureInvalidAccessToken
     * Invalid Access Token
     */
    function testErrorInvalidAccessToken(){
    	$error = Bib::find(70775700, $this->mockAccessToken);
    	$this->assertInstanceOf('BibError', $error);
    	$this->assertEquals('401', $error->getCode());
    	$this->assertEquals('AccessToken {tk_12345} is invalid', $error->getMessage());
    	$this->assertEquals('Authorization header: Bearer tk_12345', $error->getDetail());
    }
    
    /**
     * @vcr failureExpiredAccessToken
     * Expired Access Token **/
    function testFailureExpiredAccessToken()
    {
    	$error = Bib::find(70775700, $this->mockAccessToken);
    	$this->assertInstanceOf('BibError', $error);
    	$this->assertEquals('401', $error->getCode());
    	$this->assertEquals('AccessToken {tk_12345} has expired', $error->getMessage());
    	$this->assertEquals('Authorization header: Bearer tk_12345', $error->getDetail());
    }
    
    /**
     * @expectedException BadMethodCallException
     * @expectedExceptionMessage You must pass a valid Guzzle Http PSR7 Response
     */
    function testBadResponseObject()
    {
    	$error = new BibError();
    	$error->setRequestError('junk');
    }
}