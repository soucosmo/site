<?php
	class Puce {
		private $ApiKey;
		public function __construct($ApiKey) {
			if (phpversion() >= 5) {
				$this->ApiKey = $ApiKey;
			} else {
				echo json_encode(['status' => 'error', 'message' => 'it is necessary to use php in version 5 or higher']);
			}


		}

		public function cURL($data) {

			if (!empty($data) AND is_array($data)) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://puce.io/api');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				$result = curl_exec($ch);
				curl_close($ch);
				echo '<pre>';
					return json_decode($result);
				echo '</pre>';
			} else {
				echo json_encode(['status' => 'error', 'message' => 'An array is required as a parameter!']);
			}

		}

		public function Balance($coin = null) {

			if (!empty($coin) AND is_string($coin)) {
				return $this->cURL(['ApiKey' => $this->ApiKey, 'get_coin_balance' => $coin]);
			} else {
				return $this->cURL(['ApiKey' => $this->ApiKey, 'get_all_balances' => true]);
			}

		}

		public function getAddress($coin = null, $url = null) {
			if (!empty($coin) AND is_string($coin)) {
				return $this->cURL(['ApiKey' => $this->ApiKey, 'getAddress' => $coin, 'notification_url' => $url]);
			}
		}

		public function getMyAddress($coin) {
			if (!empty($coin) AND is_string($coin)) {
				return $this->cURL(['ApiKey' => $this->ApiKey, 'getMyAddress' => $coin]);
			}
		}

		public function Withdrawal($coin, $amount, $address, $payment_id = null, $url = null) {
			if (!empty($coin) AND is_string($coin) AND !empty($address)) {

				$array = array(
						'ApiKey' => $this->ApiKey,
						'withdrawal' => $coin,
						'AmountWithdrawal' => $amount,
						'WithdrawalAddress' => $address
					);

				if (!empty($payment_id)) {
					$array['WithdrawalPaymentId'] = $payment_id;
				}

				if (!empty($url)) {
					$array['url'] = $url;
				}

				return $this->cURL($array);
			}
		}

		public function getTransactions($address = null, $limit = null) {
			return $this->cURL([
				'ApiKey' => $this->ApiKey,
				'transactions' => $address,
				'limit' => $limit
			]);
		}

		public function getAltcoins($coin = null) {

			if ($coin) {
				return $this->cURL(['ApiKey' => $this->ApiKey,	'get_altcoin' => $coin]);
			} else {
				return $this->cURL(['ApiKey' => $this->ApiKey,	'all_altcoins' => true]);
			}

		}

	}
?>