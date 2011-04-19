class RenameModelColumnAssemblerId < ActiveRecord::Migration
	def self.up
		rename_column :models, :assembler_id, :ass_code
	end
	def self.down
		rename_column :models, :ass_code, :assembler_id
	end
end
