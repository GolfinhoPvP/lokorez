class Bid < ActiveRecord::Base
	belongs_to :client
	belongs_to :auction

	validates :client_id, :presence => true
	validates :auction_id, :presence => true
	validates :value, :presence => true
end
