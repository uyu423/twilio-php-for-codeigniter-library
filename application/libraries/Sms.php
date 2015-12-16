<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * YoWu - 151123
 *
 * Ref 01. https://www.twilio.com/docs/quickstart/php/sms/sending-via-rest
 * Ref 02. https://demo.twilio.com/welcome/sms/reply/
 *
 * contact me ?
 * uyu423@gmail.com 
 * https://github.com/uyu423/twilio-php-for-codeigniter-library issue tab
 *
 *
 * SQL for DB Logging (DDL Example : MySQL)
 *
 * -- log_external
 * CREATE TABLE `log_external` (
 * 	`idx`         BIGINT(20) UNSIGNED NOT NULL COMMENT 'idx', -- idx
 * 	`mod`         VARCHAR(45)         NULL     COMMENT 'mod', -- mod
 * 	`environment` VARCHAR(45)         NOT NULL COMMENT 'environment', -- environment
 * 	`result`      VARCHAR(45)         NULL     COMMENT 'result', -- result
 * 	`value`       TEXT                NULL     COMMENT 'value', -- value
 * 	`date`        DATETIME            NULL     DEFAULT CURRENT_TIMESTAMP COMMENT 'date' -- date
 * 	)
 * 	DEFAULT CHARACTER SET = 'utf8'
 * 	DEFAULT COLLATE = 'utf8_general_ci'
 * 	ENGINE = InnoDB
 * 	COMMENT 'log_external';
 *
 * 	-- log_external
 * 	ALTER TABLE `log_external`
 * 	ADD CONSTRAINT
 * 	PRIMARY KEY (
 * 	 	`idx` -- idx
 * 	)
 * 	USING BTREE;
 *
 * 	ALTER TABLE `log_external`
 * 	MODIFY COLUMN `idx` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'idx';
 *
 */

require_once 'application/libraries/Twilio-php/Services/Twilio.php';

class Sms {
	private $auth;
	private $env;
	private $version;
	private $service;

	public function __construct($config = array()) {
		$this->auth = array(
			'sid' => 'Your Twilio API SID KEY',
			'token' => 'Your Twilio API SECRET KEY',
		);

		$this->service = new Services_Twilio($this->auth['sid'], $this->auth['token']);
	}

	public function send($args) {

		if(! $args['to']) {
			echo "Exception Error. Need 'To PhoneNumber'";
			return;
		}
		try {
			$res = $this->service->account->messages->create(array(
				'To' => $args['to'],
				'From' => isset($args['from']) ? $args['from'] : "Your Default Twilio Account Tel Number",
				'Body' => isset($args['contents']) ? $args['contents'] : "Not Include Contents",
	//			'MediaUrl' => null,
			));

			/* If You want DB Logging */
			/*
			$this->logging_database(array(
				'result' => 'SUCCESS', 
				'value' => array(
					'args' => $args,
					'res' => json_decode($res),
				),
			));
			 */
		}
		catch (Services_Twilio_RestException $e) {

			/* If You want DB Logging */
			/*
			$this->logging_database(array(
				'result' => 'ERROR', 
				'value' => $e,
			));
			 */
		}
		return;
	}

	/* If You want DB Logging */
	/*
	private function logging_database($args) {
		$CI = &get_instance();
		$CI->load->model('basic_model');
		$CI->basic_model->insert(array(
			'set' => array(
				'mod' => 'twilio_sms',
				'environment' => ENVIRONMENT,
				'result' => $args['result'],
				'value' => json_encode($args['value']),
			),
			'table' => 'log_external',
		));
		return;
	}
	 */
}
