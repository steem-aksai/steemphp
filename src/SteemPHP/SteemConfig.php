<?php

namespace SteemPHP;

/**
 * SteemConfig
 *
 * This class contains config details for the steem blockchain pulled from
 * https://github.com/steemit/steem/blob/8cd5f688d75092298bcffaa48a543ed9b01447a6/libraries/protocol/include/steemit/protocol/config.hpp
 */
class SteemConfig
{
	const STEEMIT_BLOCKCHAIN_VERSION = '0.19.1';
	const STEEMIT_BLOCKCHAIN_HARDFORK_VERSION = self::STEEMIT_BLOCKCHAIN_VERSION;
	const STEEMIT_INIT_PUBLIC_KEY_STR = "STM8GC13uCZbP44HzMLV6zPZGwVQ8Nt4Kji8PapsPiNq1BK153XTX";
	const STEEMIT_CHAIN_ID = "0000000000000000000000000000000000000000000000000000000000000000";
	const VESTS_SYMBOL = 'VESTS'; // 91621639411206 VESTS with 6 digits of precision
	const STEEM_SYMBOL = 'STEEM'; // 84959911236355 STEEM with 3 digits of precision
	const SBD_SYMBOL = 'SBD'; // 1145197315 STEEM Backed Dollars with 3 digits of precision
	const STMD_SYMBOL = 'STMD'; // 293355148035 STEEM Dollars with 3 digits of precision
	const STEEMIT_SYMBOL = "STEEM";
	const STEEMIT_ADDRESS_PREFIX = "STM";
	const STEEMIT_GENESIS_TIME = 1458835200;
	const STEEMIT_MINING_TIME = 1458838800;
	const STEEMIT_CASHOUT_WINDOW_SECONDS_PRE_HF12 = 60*60*24; // 1 day
	const STEEMIT_CASHOUT_WINDOW_SECONDS_PRE_HF17 = 60*60*12; // 12 hours
	const STEEMIT_CASHOUT_WINDOW_SECONDS = 60*60*24*7; // 7 days
	const STEEMIT_SECOND_CASHOUT_WINDOW = 60*60*24*30; // 30 days
	const STEEMIT_MAX_CASHOUT_WINDOW_SECONDS = 60*60*24*14; // 2 weeks
	const STEEMIT_VOTE_CHANGE_LOCKOUT_PERIOD = 60*60*2; // 2 hours
	const STEEMIT_UPVOTE_LOCKOUT_HF7 = 60; // fc::minutes(1)
	const STEEMIT_UPVOTE_LOCKOUT_HF17 = 60*60*12; // (fc::hours(12))
	const STEEMIT_ORIGINAL_MIN_ACCOUNT_CREATION_FEE = 100000;
	const STEEMIT_MIN_ACCOUNT_CREATION_FEE = 1;
	const STEEMIT_OWNER_AUTH_RECOVERY_PERIOD = 60*60*24*30; // fc::days(30)
	const STEEMIT_ACCOUNT_RECOVERY_REQUEST_EXPIRATION_PERIOD = 60*60*24; // fc::days(1)
	const STEEMIT_OWNER_UPDATE_LIMIT = 60*60; // fc::minute(60)
	const STEEMIT_OWNER_AUTH_HISTORY_TRACKING_START_BLOCK_NUM = 3186477;
	const STEEMIT_BLOCK_INTERVAL = 3;
	const STEEMIT_BLOCKS_PER_YEAR = 365*24*60*60/self::STEEMIT_BLOCK_INTERVAL;
	const STEEMIT_BLOCKS_PER_DAY = 24*60*60/self::STEEMIT_BLOCK_INTERVAL;
	const STEEMIT_START_VESTING_BLOCK = self::STEEMIT_BLOCKS_PER_DAY * 7;
	const STEEMIT_START_MINER_VOTING_BLOCK = self::STEEMIT_BLOCKS_PER_DAY * 30;
	const STEEMIT_INIT_MINER_NAME = "initminer";
	const STEEMIT_NUM_INIT_MINERS = 1;
	const STEEMIT_INIT_TIME = 0; // fc::time_point_sec();
	const STEEMIT_MAX_WITNESSES = 21;
	const STEEMIT_MAX_VOTED_WITNESSES_HF0 = 19;
	const STEEMIT_MAX_MINER_WITNESSES_HF0 = 1;
	const STEEMIT_MAX_RUNNER_WITNESSES_HF0 = 1;
	const STEEMIT_MAX_VOTED_WITNESSES_HF17 = 20;
	const STEEMIT_MAX_MINER_WITNESSES_HF17 = 0;
	const STEEMIT_MAX_RUNNER_WITNESSES_HF17 = 1;
	const STEEMIT_HARDFORK_REQUIRED_WITNESSES = 17; // 17 of the 21 dpos witnesses (20 elected and 1 virtual time) required for hardfork. This guarantees 75% participation on all subsequent rounds.
	const STEEMIT_MAX_TIME_UNTIL_EXPIRATION = 60*60; // seconds,  aka: 1 hour
	const STEEMIT_MAX_MEMO_SIZE = 2048;
	const STEEMIT_MAX_PROXY_RECURSION_DEPTH = 4;
	const STEEMIT_VESTING_WITHDRAW_INTERVALS_PRE_HF_16 = 104;
	const STEEMIT_VESTING_WITHDRAW_INTERVALS = 13;
	const STEEMIT_VESTING_WITHDRAW_INTERVAL_SECONDS = 60*60*24*7; // 1 week per interval
	const STEEMIT_MAX_WITHDRAW_ROUTES = 10;
	const STEEMIT_SAVINGS_WITHDRAW_TIME = 60*60*24*3; // fc::days(3)
	const STEEMIT_SAVINGS_WITHDRAW_REQUEST_LIMIT = 100;
	const STEEMIT_VOTE_REGENERATION_SECONDS = 5*60*60*24; // 5 day
	const STEEMIT_MAX_VOTE_CHANGES = 5;
	const STEEMIT_REVERSE_AUCTION_WINDOW_SECONDS = 60*30; // 30 minutes
	const STEEMIT_MIN_VOTE_INTERVAL_SEC = 3;
	const STEEMIT_VOTE_DUST_THRESHOLD = 50000000;
	const STEEMIT_MIN_ROOT_COMMENT_INTERVAL = 60*5; // fc::seconds(60*5) 5 minutes
	const STEEMIT_MIN_REPLY_INTERVAL = 20; // fc::seconds(20) 20 seconds
	const STEEMIT_POST_AVERAGE_WINDOW = 60*60*24; // 1 day
	const STEEMIT_POST_MAX_BANDWIDTH = 4*self::STEEMIT_100_PERCENT; // 2 posts per 1 days, average 1 every 12 hours
	const STEEMIT_POST_WEIGHT_CONSTANT = self::STEEMIT_POST_MAX_BANDWIDTH * self::STEEMIT_POST_MAX_BANDWIDTH;
	const STEEMIT_MAX_ACCOUNT_WITNESS_VOTES = 30;
	const STEEMIT_100_PERCENT = 10000;
	const STEEMIT_1_PERCENT = self::STEEMIT_100_PERCENT/100;
	const STEEMIT_1_TENTH_PERCENT = self::STEEMIT_100_PERCENT/1000;
	const STEEMIT_DEFAULT_SBD_INTEREST_RATE = 10*self::STEEMIT_1_PERCENT; //< 10% APR
	const STEEMIT_INFLATION_RATE_START_PERCENT = 978; // Fixes block 7,000,000 to 9.5%
	const STEEMIT_INFLATION_RATE_STOP_PERCENT = 95; // 0.95%
	const STEEMIT_INFLATION_NARROWING_PERIOD = 250000; // Narrow 0.01% every 250k blocks
	const STEEMIT_CONTENT_REWARD_PERCENT = 75*self::STEEMIT_1_PERCENT; //75% of inflation, 7.125% inflation
	const STEEMIT_VESTING_FUND_PERCENT = 15*self::STEEMIT_1_PERCENT; //15% of inflation, 1.425% inflation
	const STEEMIT_MINER_PAY_PERCENT = self::STEEMIT_1_PERCENT; // 1%
	const STEEMIT_MIN_RATION = 100000;
	const STEEMIT_MAX_RATION_DECAY_RATE = 1000000;
	const STEEMIT_FREE_TRANSACTIONS_WITH_NEW_ACCOUNT = 100;
	const STEEMIT_BANDWIDTH_AVERAGE_WINDOW_SECONDS = 60*60*24*7; //< 1 week
	const STEEMIT_BANDWIDTH_PRECISION = 1000000; //< 1 million
	const STEEMIT_MAX_COMMENT_DEPTH_PRE_HF17 = 6;
	const STEEMIT_MAX_COMMENT_DEPTH = 0xffff; // 64k
	const STEEMIT_SOFT_MAX_COMMENT_DEPTH = 0xff; // 255
	const STEEMIT_MAX_RESERVE_RATIO = 20000;
	const STEEMIT_CREATE_ACCOUNT_WITH_STEEM_MODIFIER = 30;
	const STEEMIT_CREATE_ACCOUNT_DELEGATION_RATIO = 5;
	const STEEMIT_CREATE_ACCOUNT_DELEGATION_TIME = 60*60*24*30; // fc::days(30)
	const STEEMIT_MINING_REWARD = (1000/self::STEEMIT_BLOCKCHAIN_PRECISION).' '.self::STEEM_SYMBOL;
	const STEEMIT_EQUIHASH_N = 140;
	const STEEMIT_EQUIHASH_K = 6;
	const STEEMIT_LIQUIDITY_TIMEOUT_SEC = 60*60*24*7; // (fc::seconds(60*60*24*7)) After one week volume is set to 0
	const STEEMIT_MIN_LIQUIDITY_REWARD_PERIOD_SEC = 60; // (fc::seconds(60)) 1 minute required on books to receive volume
	const STEEMIT_LIQUIDITY_REWARD_PERIOD_SEC = 60*60;
	const STEEMIT_LIQUIDITY_REWARD_BLOCKS = self::STEEMIT_LIQUIDITY_REWARD_PERIOD_SEC/self::STEEMIT_BLOCK_INTERVAL;
	const STEEMIT_MIN_LIQUIDITY_REWARD = ((1000*self::STEEMIT_LIQUIDITY_REWARD_BLOCKS)/self::STEEMIT_BLOCKCHAIN_PRECISION).' '.self::STEEM_SYMBOL; // Minumum reward to be paid out to liquidity providers
	const STEEMIT_MIN_CONTENT_REWARD = self::STEEMIT_MINING_REWARD;
	const STEEMIT_MIN_CURATE_REWARD = self::STEEMIT_MINING_REWARD;
	const STEEMIT_MIN_PRODUCER_REWARD = self::STEEMIT_MINING_REWARD;
	const STEEMIT_MIN_POW_REWARD = self::STEEMIT_MINING_REWARD;
	const STEEMIT_ACTIVE_CHALLENGE_FEE = (2000/self::STEEMIT_BLOCKCHAIN_PRECISION).' '.self::STEEM_SYMBOL;
	const STEEMIT_OWNER_CHALLENGE_FEE = (30000/self::STEEMIT_BLOCKCHAIN_PRECISION).' '.self::STEEM_SYMBOL;
	const STEEMIT_ACTIVE_CHALLENGE_COOLDOWN = 60*60*24; // fc::days(1)
	const STEEMIT_OWNER_CHALLENGE_COOLDOWN = 60*60*24; // fc::days(1)
	const STEEMIT_POST_REWARD_FUND_NAME = "post";
	const STEEMIT_COMMENT_REWARD_FUND_NAME = "comment";
	const STEEMIT_RECENT_RSHARES_DECAY_RATE_HF17 = 60*60*24*30; // (fc::days(30))
	const STEEMIT_RECENT_RSHARES_DECAY_RATE_HF19 = 60*60*24*15; // (fc::days(15))
	const STEEMIT_CONTENT_CONSTANT_HF0 = 2000000000000; //uint128_t(2000000000000);
	// note, if redefining these constants make sure calculate_claims doesn't overflow
	// 5ccc e802 de5f
	// int(expm1( log1p( 1 ) / BLOCKS_PER_YEAR ) * 2**STEEMIT_APR_PERCENT_SHIFT_PER_BLOCK / 100000 + 0.5)
	// we use 100000 here instead of 10000 because we end up creating an additional 9x for vesting
	const STEEMIT_APR_PERCENT_MULTIPLY_PER_BLOCK = 102035135585887; // ((uint64_t(0x5ccc)<<0x20)|(uint64_t(0xe802)<<0x10)|(uint64_t(0xde5f)))
	// chosen to be the maximal value such that STEEMIT_APR_PERCENT_MULTIPLY_PER_BLOCK * 2**64 * 100000 < 2**128
	const STEEMIT_APR_PERCENT_SHIFT_PER_BLOCK = 87;
	const STEEMIT_APR_PERCENT_MULTIPLY_PER_ROUND = 133921203762304; //((uint64_t(0x79cc)<<0x20)|(uint64_t(0xf5c7)<<0x10)|(uint64_t(0x3480)))
	const STEEMIT_APR_PERCENT_SHIFT_PER_ROUND = 83;
	// We have different constants for hourly rewards
	// i.e. hex(int(math.expm1( math.log1p( 1 ) / HOURS_PER_YEAR ) * 2**STEEMIT_APR_PERCENT_SHIFT_PER_HOUR / 100000 + 0.5))
	const STEEMIT_APR_PERCENT_MULTIPLY_PER_HOUR = 119577151364285; // ((uint64_t(0x6cc1)<<0x20)|(uint64_t(0x39a1)<<0x10)|(uint64_t(0x5cbd)))
	// chosen to be the maximal value such that STEEMIT_APR_PERCENT_MULTIPLY_PER_HOUR * 2**64 * 100000 < 2**128
	const STEEMIT_APR_PERCENT_SHIFT_PER_HOUR = 77;
	// These constants add up to GRAPHENE_100_PERCENT.  Each GRAPHENE_1_PERCENT is equivalent to 1% per year APY
	// *including the corresponding 9x vesting rewards*
	const STEEMIT_CURATE_APR_PERCENT = 3875;
	const STEEMIT_CONTENT_APR_PERCENT = 3875;
	const STEEMIT_LIQUIDITY_APR_PERCENT = 750;
	const STEEMIT_PRODUCER_APR_PERCENT = 750;
	const STEEMIT_POW_APR_PERCENT = 750;
	const STEEMIT_MIN_PAYOUT_SBD = (20/self::STEEMIT_BLOCKCHAIN_PRECISION).' '.self::SBD_SYMBOL;
	const STEEMIT_SBD_STOP_PERCENT = 5*self::STEEMIT_1_PERCENT; // Stop printing SBD at 5% Market Cap
	const STEEMIT_SBD_START_PERCENT = 2*self::STEEMIT_1_PERCENT; // Start reducing printing of SBD at 2% Market Cap
	const STEEMIT_MIN_ACCOUNT_NAME_LENGTH = 3;
	const STEEMIT_MAX_ACCOUNT_NAME_LENGTH = 16;
	const STEEMIT_MIN_PERMLINK_LENGTH = 0;
	const STEEMIT_MAX_PERMLINK_LENGTH = 256;
	const STEEMIT_MAX_WITNESS_URL_LENGTH = 2048;
	const STEEMIT_INIT_SUPPLY = 0;
	const STEEMIT_MAX_SHARE_SUPPLY = 1000000000000000;
	const STEEMIT_MAX_SIG_CHECK_DEPTH = 2;
	const STEEMIT_MIN_TRANSACTION_SIZE_LIMIT = 1024;
	const STEEMIT_SECONDS_PER_YEAR = 60*60*24*365;
	const STEEMIT_SBD_INTEREST_COMPOUND_INTERVAL_SEC = 60*60*24*30;
	const STEEMIT_MAX_TRANSACTION_SIZE = 1024*64;
	const STEEMIT_MIN_BLOCK_SIZE_LIMIT = self::STEEMIT_MAX_TRANSACTION_SIZE;
	const STEEMIT_MAX_BLOCK_SIZE = self::STEEMIT_MAX_TRANSACTION_SIZE*self::STEEMIT_BLOCK_INTERVAL*2000;
	const STEEMIT_BLOCKS_PER_HOUR = 60*60/self::STEEMIT_BLOCK_INTERVAL;
	const STEEMIT_FEED_INTERVAL_BLOCKS = self::STEEMIT_BLOCKS_PER_HOUR;
	const STEEMIT_FEED_HISTORY_WINDOW_PRE_HF_16 = 24*7; // 7 days * 24 hours per day
	const STEEMIT_FEED_HISTORY_WINDOW = 12*7; // 3.5 days
	const STEEMIT_MAX_FEED_AGE_SECONDS = 60*60*24*7; // 7 days
	const STEEMIT_MIN_FEEDS = self::STEEMIT_MAX_WITNESSES/3; // protects the network from conversions before price has been established
	const STEEMIT_CONVERSION_DELAY_PRE_HF_16 = 60*60*24*7; // fc::days(7)
	const STEEMIT_CONVERSION_DELAY = self::STEEMIT_FEED_HISTORY_WINDOW*60; //fc::hours(STEEMIT_FEED_HISTORY_WINDOW) 3.5 day conversion
	const STEEMIT_MIN_UNDO_HISTORY = 10;
	const STEEMIT_MAX_UNDO_HISTORY = 10000;
	const STEEMIT_MIN_TRANSACTION_EXPIRATION_LIMIT = self::STEEMIT_BLOCK_INTERVAL * 5; // 5 transactions per block
	const STEEMIT_BLOCKCHAIN_PRECISION = 1000;
	const STEEMIT_BLOCKCHAIN_PRECISION_DIGITS = 3;
	const STEEMIT_MAX_INSTANCE_ID = 281474976710655; // uint64_t(-1)>>16
	/** NOTE: making this a power of 2 (say 2^15) would greatly accelerate fee calcs */
	const STEEMIT_MAX_AUTHORITY_MEMBERSHIP = 10;
	const STEEMIT_MAX_ASSET_WHITELIST_AUTHORITIES = 10;
	const STEEMIT_MAX_URL_LENGTH = 127;
	const STEEMIT_IRREVERSIBLE_THRESHOLD = 75 * self::STEEMIT_1_PERCENT;
	// VIRTUAL_SCHEDULE_LAP_LENGTH and VIRTUAL_SCHEDULE_LAP_LENGTH2 has to be compiled
	// with fc inorder to get a value
	const VIRTUAL_SCHEDULE_LAP_LENGTH = null; // fc::uint128(uint64_t(-1))
	const VIRTUAL_SCHEDULE_LAP_LENGTH2 = null; // fc::uint128::max_value()
	/**
	 *  Reserved Account IDs with special meaning
	 */
	//@{
	// Represents the current witnesses
	const STEEMIT_MINER_ACCOUNT = "miners";
	// Represents the canonical account with NO authority (nobody can access funds in null account)
	const STEEMIT_NULL_ACCOUNT = "null";
	// Represents the canonical account with WILDCARD authority (anybody can access funds in temp account)
	const STEEMIT_TEMP_ACCOUNT = "temp";
	// Represents the canonical account for specifying you will vote for directly (as opposed to a proxy)
	const STEEMIT_PROXY_TO_SELF_ACCOUNT = "";
	// Represents the canonical root post parent account
	//const STEEMIT_ROOT_POST_PARENT = (account_name_type())
	//@}

}

?>
