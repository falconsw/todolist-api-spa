import React, {Component} from "react";

class TodoListItems extends Component {

    createTodoListItems = item => {
        return (
            <li key={item.id}  className="w-full px-4 py-4 border-b border-gray-200 dark:border-gray-600">
                <div className="flex">
                    <div className="flex items-center mr-4">
                        <input onClick={() => this.props.updateItem(item.id)} type="checkbox" value="" id={"todo-"+item.id}
                               className="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked={item.status}/>
                        <label htmlFor={"todo-"+item.id} className={"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" + (item.status ? "line-through dark:text-gray-400" : "")}>{ item.title } { item.status ? "true" : "false" }</label>
                    </div>

                    <div className="flex items-center ml-auto">
                        <button onClick={() => this.props.deleteItem(item.id)} type="button"
                                className="bg-red-500 hover:bg-red-700 text-white font-bold py-0 px-4 rounded">
                            Del
                        </button>
                    </div>
                </div>
            </li>
        );
    }

    render() {
        const todoListItems = this.props.todoListItems;
        const listItems = todoListItems.map(this.createTodoListItems);


        return (
            <div className="mt-12 ml-10">
                <h2 className="text-lg font-bold mb-2 text-white text-center">Todo List</h2>
                <ul className="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    {listItems}
                </ul>
            </div>
        );

    }
}

export default TodoListItems;