<?php
	namespace Tools;
	
	class Session{
		private static $regenerateTime = 60;
		private static $regenrateRequest = 10;

		private static $active = 'active';
		private static $ip = 'ip';
		private static $startTime = 'time';
		private static $reqCount = 'request';		
		
		public static function start() {
			session_start();
		}

		public static function initialize() {
			self::start();
			if(self::is(self::$active) === true){
				self::set(self::$reqCount, self::get(self::$reqCount) + 1);
				self::check();
			}
			else {
				self::set(self::$active, true);
				self::set(self::$ip, $_SERVER['REMOTE_ADDR']);//'192.168.1.1'
				self::set(self::$startTime, time());
				self::set(self::$reqCount, 1);
			}
		}	

		public static function check(){
			$error = false;
			if(self::get(self::$ip) !== $_SERVER['REMOTE_ADDR'])
				$error = true;

			if($error === true){
				self::destroy();
				//die('Proba przejecia sesji!');
				return false;
			}

			$now = time();
			if ($now > self::get(self::$startTime) + self::$regenerateTime
				|| self::get(self::$reqCount) > self::$regenrateRequest)
			{
				self::regenerate();
			}
			return true;
		}

		public static function set($name, $value) {
			$_SESSION[$name] = $value;
		}		

		public static function get($name) {
			if(self::is($name))
				return $_SESSION[$name];
			else
				return null;
		}	

		public static function is($name) {
			return isset($_SESSION[$name]);
		}	

		public static function clear($name) {
			unset($_SESSION[$name]);
		}

		public static function clearAll() {
			$_SESSION = array();
		}	

		public static function destroy() {
			self::clearAll();
			if (isset($_COOKIE[session_name()])) { 
				setcookie(session_name(), '', time()-42000, '/'); 
			}
			session_destroy();
		}		

		public static function name($name=null) {
			if($name !== null)
				return session_name($name);
			else
				return session_name();
		}		
		
		public static function regenerate() {
			session_regenerate_id();
			self::set(self::$startTime, time());
			self::set(self::$reqCount, 1);
		}
	}