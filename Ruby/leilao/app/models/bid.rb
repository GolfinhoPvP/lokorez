class Bid < ActiveRecord::Base
	belongs_to :clients
	belongs_to :auctions

	validates :client_id, :presence => true
	validates :auction_id, :presence => true
	validates :value, :presence => true, :format => { :with => /^[0-9]+\,[0-9]{1,2}$/ }
end
