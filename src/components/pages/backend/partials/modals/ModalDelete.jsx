import { Trash2, X } from "lucide-react";
import React from "react";
import ModalWrapper from "./ModalWrapper";
import SpinnerButton from "../spinners/SpinnerButton";
import { StoreContext } from "@/components/store/storeContext";
import { setIsDelete, setMessage, setSuccess, setValidate } from "@/components/store/storeAction";
import { useMutation, useQueryClient } from "@tanstack/react-query";
import { queryData } from "@/components/helpers/queryData";

const ModalDelete = ({ mysqlApiDelete, queryKey, item }) => {
  const { dispatch } = React.useContext(StoreContext);
  const queryClient = useQueryClient();

  const mutation = useMutation({
    mutationFn: (values) => queryData(mysqlApiDelete, "delete", values),
    onSuccess: (data) => {
      queryClient.invalidateQueries({ queryKey: [queryKey] });
      handleClose();
      if (!data.success) {
        dispatch(setValidate(true));
        dispatch(setMessage(data.error));
      } else {
        dispatch(setIsDelete(false));
        dispatch(setSuccess(true));
        dispatch(setMessage("Record Successfully Deleted"));
      }
    },
  });

  const handleYes = async () => {
    mutation.mutate({
      item: "xxx",
    });
  };

  const handleClose = () => dispatch(setIsDelete(false));
  return (
    <>
      <ModalWrapper>
        <div className="modal-main bg-primary absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 max-w-[400px] w-full rounded-md border border-line">
          <div className="modal-header flex gap-2 p-2 items-center border-b border-line mb-2 ">
            <Trash2 size={16} stroke={"red"} />
            <span className="text-alert">Delete</span>
            <button className="ml-auto" onClick={handleClose}>
              <X />
            </button>
          </div>
          <div className="modal-body p-2 py-4">
            <p className="mb-0 text-center">
              Are you sure you want to delete this question?
            </p>

            <div className="flex justify-end gap-3 mt-5">
              <button className="btn btn-alert" onClick={handleYes}>
                {mutation.isPending && <SpinnerButton />}
                Delete
              </button>
              <button className="btn btn-cancel" onClick={handleClose}>
                Cancel
              </button>
            </div>
          </div>
        </div>
      </ModalWrapper>
    </>
  );
};

export default ModalDelete;
