class Auction < ActiveRecord::Base
	has_and_belongs_to_many :clients
	belongs_to :cars
	has_many :bids

	validates :car_id, :presence => true
	validates :auction_start, :presence => true
	validates :initial_value, :presence => true
	validates :buy_now_value, :presence => true
	#validates :capping_value, :presence => true
	#validates :capping_value, :presence => true, :format => { :with => /^[0-9]+,[0-9]{1,2}$/ }
	validates :status, :presence => true
end