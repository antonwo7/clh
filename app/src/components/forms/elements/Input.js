import React, { Component } from 'react';
import {connect} from "react-redux";
import {NumericFormat} from "react-number-format";

class Input extends Component {

    constructor(props) {
        super(props)

        this.state = {
            value: this.props.value ? this.props.value : null
        }
    }

    changeHandle = (e) => {
        this.props.onChange && this.props.onChange(e.target.value)
        this.setState({value: e.target.value})
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if (this.props.value !== prevProps.value) {
            this.setState({ value: this.props.value })
        }
    }

    render() {
        const inputClassName = 'block w-full flex-1 rounded-none rounded-r-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3' + (this.props.inputClassName ? ' ' + this.props.inputClassName : '') + (!this.props.title ? ' ' + 'rounded-l-md' : '')
        const labelClassName = 'inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500' + (this.props.labelClassName ? ' ' + this.props.labelClassName : '')
        const isPrice = this.props.format === 'price'

        const properties = {
            type: this.props.type,
            name: this.props.name,
            id: this.props.id,
            className: inputClassName,
            required: this.props.required,
            value: this.state.value ? this.state.value : '',
            onChange: this.changeHandle
        }

        const style = this.props.style ? this.props.style : {}
        const ref = this.props.refer ? this.props.refer : null
        const multiple = this.props.multiple ? this.props.multiple : null

        if (isPrice) {
            properties['allowedDecimalSeparators'] = ['%']
            properties['decimalScale'] = this.props.decimalScale === undefined
                ? 2
                : this.props.decimalScale;
        }

        if (ref) {
            properties['ref'] = ref
        }

        if (multiple) {
            properties['multiple'] = true
        }


        return (
            <div className="flex rounded-md shadow-sm" style={style}>
                {this.props.title && <label htmlFor={this.props.id} className={labelClassName}>{this.props.title}</label>}
                {isPrice
                    ? <NumericFormat {...properties} />
                    : <input {...properties} />
                }
            </div>
        )
    }
}

export default connect(
    state => {
        return {

        }
    },
    { }
)(Input);