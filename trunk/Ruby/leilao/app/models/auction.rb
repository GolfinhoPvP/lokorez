class Auction < ActiveRecord::Base
	has_and_belongs_to_many :clients
	has_many :cars

	validates :car_code, :presence => true
	validates :auction_start, :presence => true
	validates :initial_value, :presence => true, :format => { :with => /^[0-9]+\,[0-9]{1,2}$/ }
	validates :buy_now_value, :presence => true, :format => { :with => /^[0-9]+\,[0-9]{1,2}$/ }
	validates :capping_value, :presence => true, :format => { :with => /^[0-9]+\,[0-9]{1,2}$/ }
	validates :status, :presence => true
end
