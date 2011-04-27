<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Generated	by NCL Eclipse -->
<ncl id="conectors" xmlns="http://www.ncl.org.br/NCL3.0/EDTVProfile">
	<head>
		<connectorBase>
			<causalConnector id="onBeginStart">
				<simpleCondition role="onBegin"/>
				<simpleAction role="start" max="unbounded"/>
			</causalConnector>
			
			<causalConnector id="onEndStart">
				<simpleCondition role="onEnd"/>
				<simpleAction role="start" max="unbounded"/>
			</causalConnector>
			
			<causalConnector id="onEndStop">
				<simpleCondition role="onEnd"/>
				<simpleAction role="stop" max="unbounded"/>
			</causalConnector>
			
			<causalConnector id="onEndAbortStop">
				<simpleCondition role="onEnd"/>
				<compoundAction operator="par">	
					<simpleAction role="abort" max="unbounded"/>
					<simpleAction role="stop" max="unbounded"/>
				</compoundAction>
			</causalConnector>
			
			<causalConnector id="onEndAbort">
				<simpleCondition role="onEnd"/>
				<simpleAction role="abort" max="unbounded"/>
			</causalConnector>
			
			<causalConnector id="onAbortAbort">
				<simpleCondition role="onAbort"/>
				<simpleAction role="abort" max="unbounded"/>
			</causalConnector>
			
			<causalConnector id="onSelectionStart">
				<connectorParam name="key"/>
				<simpleCondition role="onSelection" key="$key"/>
				<simpleAction role="start" max="unbounded"/>
			</causalConnector>
		</connectorBase>
	</head>
</ncl>